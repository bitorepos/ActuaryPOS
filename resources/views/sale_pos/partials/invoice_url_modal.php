<!-- Edit Invocie Tax Modal -->
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><?php echo app('translator')->get('lang_v1.view_invoice_url'); ?> - <?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->invoice_no, false); ?></h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<input type="text" class="form-control" value="<?php echo e($url, false); ?>" id="invoice_url">
				<p class="help-block"><?php echo app('translator')->get('lang_v1.invoice_url_help'); ?></p>
			</div>
		</div>
		<div class="modal-footer">
		    <a href="<?php echo e($url, false); ?>" id="view_invoice_url" target="_blank" rel="noopener" class="btn btn-primary">
				<?php echo app('translator')->get('messages.view'); ?>
			</a>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
	$('input#invoice_url').click(function(){
		$(this).select().focus();
	});
</script>
