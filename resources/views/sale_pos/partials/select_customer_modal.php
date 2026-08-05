<div class="modal fade" id="require_customer_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title">
				Select Customer
			</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="mb-3">
						<?php echo Form::text('require_customer', null, ['class' => 'form-control mousetrap', 'id' => 'require_customer', 'autofocus'=> true, 'placeholder' => 'Enter Customer ID / Name', 'required']); ?>

					</div>
				</div>
			</div>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
