<!-- Numpad Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="change_return_modal">
	<div class="modal-dialog modal-sm" role="document" style="padding-top:10%">
		<div class="modal-content no-print">
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6"><?php echo app('translator')->get('sale.total_payable'); ?>:</div>
					<div class="col-md-6"><span class="lead text-bold total_payable_cr_modal">0</span></div>
					<div class="col-md-6"><?php echo app('translator')->get('lang_v1.total_paying'); ?>:</div>
					<div class="col-md-6"><span class="lead text-bold total_paying_cr_modal">0</span></div>
					<div class="col-md-6"><?php echo app('translator')->get('lang_v1.change_return'); ?>:</div>
					<div class="col-md-6"><span class="lead text-bold change_return_cr_modal text-danger">0</span></div>
				</div>
			</div>
			<div class="modal-footer text-center">
			    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
