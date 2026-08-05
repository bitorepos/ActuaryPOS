<div class="modal-dialog" role="document" style="padding-top:5%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">Are you Sure?</h4>
			</div>
			<div class="modal-body">
				<form id="user-authenticate-form" action="/sells/user-authenticate-perform" method="post" autocomplete="off">
				<?php echo csrf_field(); ?>
				<div class="row">
					<?php if(!empty($reasons)): ?>
					<div class="col-md-12">
					<?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(!empty($reason) && $key != 'other'): ?>
						<div class="form-check">
							<input class="form-check-input" type="radio" required name="reason" id="reason<?php echo e($loop->index, false); ?>" value="<?php echo e($reason, false); ?>">
							<label class="form-check-label" for="reason<?php echo e($loop->index, false); ?>">
								<?php echo e($reason, false); ?>

							</label>
						</div>
						<?php elseif($key == 'other' && !empty($reason)): ?>
						  <div class="form-check">
							<input class="form-check-input" type="radio" name="reason" id="reason4" value="other">
							<label class="form-check-label" for="reason4">
							  Other
							</label>
							<input type="text" name="other_reason" placeholder="Write other Reason" autocomplete="off" class="form-control" id='other_reason'>
						  
						  </div>
						  <div class="mb-3">
							</div>
						<?php endif; ?>					
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    </div>
					<?php endif; ?>
					<?php if($ask_password): ?>
					<div class="col-md-12">
				        <div class="mb-3">
							<label for="permission_password">Password</label>
							<input type="password" name="permission_password" class="form-control" id='permission_password'>
						</div>
				    </div>
					<?php endif; ?>
					<div class="col-md-12">
						<input type="hidden" id="type" name="type" value="<?php echo e($type, false); ?>">
						<input type="hidden" id="transaction_id" name="transaction_id" value="<?php echo e($transaction_id, false); ?>">
						<input type="hidden" id="user_id" name="user_id" value="<?php echo e($user_id, false); ?>">
						<button class="btn btn-primary" type="submit" id="perform-authenticate-action">Perform Action</button>
						<button class="btn" data-bs-dismiss="modal">Close</button>
					</div>
				</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
