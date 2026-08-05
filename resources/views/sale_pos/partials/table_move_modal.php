<div class="modal-dialog modal-sm" role="document" style="padding-top:10%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">
					 Move Table Orders
				</h4>
			</div>
			<div class="modal-body">
					<div class="mb-3">
						<label for="move_to_table">Move To:</label>
						<select class="form-control" id="qm_move_to_table">
							<?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($t->id, false); ?>"><?php echo e($t->name, false); ?></option>								
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
					<button class="btn btn-lg btn-primary btn-block" id="move_table_orders_btn" style="padding:20px auto;" value="ready">
						Move
					</button>
					<button class="btn btn-lg btn-warning btn-block" id="move_table_orders_btn" data-print='true' style="padding:20px auto;" value="ready">
						Print
					</button>
					<button class="btn btn-lg bg-secondary btn-block" style="padding:20px auto;" data-bs-dismiss="modal">
						Close
					</button>
	
			</div>			
		</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
