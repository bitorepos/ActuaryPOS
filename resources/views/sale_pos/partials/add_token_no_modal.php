<div class="modal fade" id="add_token_no_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" data-backdrop="static" data-keyboard="false" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					<?php if(!empty($pos_settings['prompt_token_label'])): ?> <?php echo e($pos_settings['prompt_token_label'], false); ?> <?php else: ?> <?php echo e('Token No', false); ?> <?php endif; ?> 
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
				        <div class="mb-3">
							<input type="text" name="modal_token_no_input" class="form-control" id='modal_token_no_input'>
						</div>
				    </div>
				</div>
			</div>
		</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
