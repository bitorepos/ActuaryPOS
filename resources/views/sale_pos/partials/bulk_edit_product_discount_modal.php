<!-- Edit Invocie Tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="bulk_edit_product_discount_modal">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('sale.edit_products_discounts'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<?php echo Form::label('bulk_select_discount', 'Search Discount Name:' ); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
					<?php echo Form::select("bulk_select_discount", [], null, ['class' => 'form-control select2', 'placeholder' => 'Please Select', 'style'=>'width:80%']); ?>

					</div>
				</div>
				<div class="mb-3">
					<?php
					$max_discount = !is_null(auth()->user()->max_sales_discount_percent) ? auth()->user()->max_sales_discount_percent : '';
					?>
					<?php echo Form::label('bulk_product_discount', __('sale.discount') . ' (%):' ); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
					<?php echo Form::text("bulk_product_discount", number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'data-rule-max-value'=> !empty($max_discount) ? number_format($max_discount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : '', 'data-msg-max-value'=> "Max Discount % Allowed is $max_discount"]); ?>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="bulk_edit_product_discount_update"><?php echo app('translator')->get('messages.apply'); ?></button>
			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.cancel' ); ?></button>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
