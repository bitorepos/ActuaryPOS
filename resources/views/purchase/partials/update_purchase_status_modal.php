<div class="modal fade" id="update_purchase_status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" style="z-index: 1090 !important;">
        

	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">

		<?php echo Form::open(['url' => action([\App\Http\Controllers\PurchaseController::class, 'updateStatus']), 'method' => 'post', 'id' => 'update_purchase_status_form' ]); ?>


		<div class="modal-header">
			<h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.update_status' ); ?></h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

		<div class="modal-body">
			<div class="mb-3">
				<?php echo Form::label('status', __('purchase.purchase_status') . ':*'); ?> 
				<?php echo Form::select('status', $orderStatuses, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required']); ?>


				<?php echo Form::hidden('purchase_id', null, ['id' => 'purchase_id']); ?>

			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		</div>

		<?php echo Form::close(); ?>


		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
