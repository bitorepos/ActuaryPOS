<div class="modal fade" id="mobile_product_suggestion_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<!-- Edit Invocie Tax Modal -->
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content bg-gray">
			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<?php echo $__env->make('sale_pos.partials.pos_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
