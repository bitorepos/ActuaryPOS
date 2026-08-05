<!-- Edit Invocie Tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="bulk_edit_product_discount_modal">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('sale.edit_products_discounts'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<?php echo Form::label('bulk_product_discount', 'Unit Discount (%):' ); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
					<?php echo Form::number("bulk_product_discount", number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'min'=>'1', 'max' =>'100']); ?>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="bulk_edit_product_discount_update"><?php echo app('translator')->get('messages.update'); ?></button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
