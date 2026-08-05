<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\OpeningStockController::class, 'save']), 'method' => 'post', 'id' => 'add_opening_stock_form' ]); ?>

	<?php echo Form::hidden('product_id', $product->id); ?>

		<div class="modal-header">
			<h4 class="modal-title" id="modalTitle"><?php echo app('translator')->get('lang_v1.add_opening_stock'); ?></h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
	    </div>
	    <div class="modal-body">
			<?php echo $__env->make('opening_stock.form-part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary add_opening_stock_btn" data-button-type="ajax" id="add_opening_stock_btn"><?php echo app('translator')->get('messages.save'); ?></button>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		 </div>
	 <?php echo Form::close(); ?>

	</div>
</div>
