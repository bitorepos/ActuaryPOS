<div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
  <div class="modal-content">
    <?php echo $__env->make('purchase.partials.show_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="modal-footer">
      
      <a href="#" class="btn btn-primary no-print print-invoice" data-href="<?php echo e(action('App\Http\Controllers\PurchaseController@printInvoice', [$purchase->id]), false); ?>"><i class="fas fa-print" aria-hidden="true"></i> <?php echo app('translator')->get('messages.print'); ?></a>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var element = $('div.modal-xl');
		__currency_convert_recursively(element);
	});
</script>
