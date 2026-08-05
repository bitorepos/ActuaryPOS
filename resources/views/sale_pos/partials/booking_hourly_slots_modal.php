<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
			
			<h4 class="modal-title" id="myModalLabel">
				<?php echo e($product->name, false); ?> - Time Slots ( <?php echo e(\Carbon::createFromTimestamp(strtotime($start))->format(session('business.date_format')) .' - '. \Carbon::createFromTimestamp(strtotime($end))->format(session('business.date_format')), false); ?>)
			</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
					<table class="table table-bordered table-striped table-th-skin">
						<thead>
							<tr>
								<th class="width-10 text-center">Date</th>
								<th class="width-90 text-center">Time Slots</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $hours): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td  class="width-10 text-center"><h3><?php echo e(\Carbon::createFromTimestamp(strtotime($date))->format(session('business.date_format')), false); ?></h3></td>
								<td>
									<div class="option-div-group">
									<?php $__currentLoopData = $hours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $h): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php
										$isChecked = isset($selected[$date]) && in_array($h, $selected[$date]);
										$isBooked = isset($booked[$date]) && in_array($h, $booked[$date]) ? ['disabled'] : [];
									?>
									<div style="width:10%;display: inline-block;">
										<div class="mb-3">
											<div class="option-div <?php if($isChecked): ?> active <?php endif; ?> <?php if($isBooked): ?> bg-red <?php endif; ?>" style="padding:5px">
												<h4><?php echo e(\Carbon::createFromTimestamp(strtotime($h))->format('h:i A'), false); ?> <i class="fa fa-check-circle float-end icon"></i></h4>
												<?php echo Form::radio('product['.$row_count.'][booking_dates]['.$date.']', $h, $isChecked, $isBooked); ?>

											</div>
										</div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
           <button type="button" class="btn btn-primary btn-lg hourly_slots_save" data-row_count="<?php echo e($row_count, false); ?>"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>
</div>
<style>
.modal {
    overflow-y: auto !important;
}

.modal-body {
    max-height: calc(100vh - 180px);
    overflow-y: auto;
}
</style>
