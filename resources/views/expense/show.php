<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    <?php echo $__env->make('expense.partials.show_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i><?php echo app('translator')->get( 'messages.close' ); ?></button>
      <a href="#" class="btn btn-primary no-print print-expense" data-href="<?php echo e(action('App\Http\Controllers\ExpenseController@printExpense', [$expense->id]), false); ?>"><i class="fas fa-print" aria-hidden="true"></i> <?php echo app('translator')->get('messages.thermal_print'); ?></a>
      <button type="button" class="btn btn-primary no-print" aria-label="Print" 
      onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print me-1"></i><?php echo app('translator')->get( 'messages.print' ); ?>
      </button>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var element = $('div.modal-xl');
		__currency_convert_recursively(element);
	});
</script>
