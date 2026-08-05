<!-- Edit Invocie Tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="bulk_edit_product_tax_modal">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('sale.edit_products_tax'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<?php echo Form::label('bulk_product_tax', __('sale.tax') . ':' ); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
						<?php echo Form::select('bulk_product_tax', $taxes['tax_rates'], $selected_tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control'], $taxes['attributes']); ?>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="bulk_edit_product_tax_update"><?php echo app('translator')->get('messages.apply'); ?></button>
			    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.cancel' ); ?></button>

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
