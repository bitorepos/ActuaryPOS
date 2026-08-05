<!-- Edit Invocie Tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="posEditOrderTaxModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('sale.edit_order_tax'); ?></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
				        <div class="mb-3">
				            <?php echo Form::label('order_tax_modal', __('sale.order_tax') . ':*' ); ?>

				            <div class="input-group">
				                <span class="input-group-text">
				                    <i class="fa fa-info"></i>
				                </span>
				                <?php echo Form::select('order_tax_modal', $taxes['tax_rates'], $selected_tax, ['placeholder' => __('messages.please_select'), 'class' => 'form-control'], $taxes['attributes']); ?>

				            </div>
				        </div>
				    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="posEditOrderTaxModalUpdate"><?php echo app('translator')->get('messages.update'); ?></button>
			    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
				
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
