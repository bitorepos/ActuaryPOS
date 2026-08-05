<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.booking_details' ); ?></h4>
			</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<strong><?php echo app('translator')->get('contact.customer'); ?>:</strong> <?php echo e($booking->customer->name, false); ?><br>
						<strong><?php echo app('translator')->get('restaurant.service_staff'); ?>:</strong> <?php echo e($booking->waiter->user_full_name ?? '--', false); ?><br>
						<strong><?php echo app('translator')->get('restaurant.correspondent'); ?>:</strong> <?php echo e($booking->correspondent->user_full_name ?? '--', false); ?><br>
						<?php if(!empty($booking->booking_note)): ?>
						<strong><?php echo app('translator')->get('restaurant.customer_note'); ?>:</strong> <?php echo e($booking->booking_note, false); ?>

						<?php endif; ?>
					</div>
					<div class="col-sm-6">
						<strong><?php echo app('translator')->get('messages.location'); ?>:</strong> <?php echo e($booking->location->name, false); ?><br>
						<strong><?php echo app('translator')->get('restaurant.table'); ?>:</strong> <?php echo e($booking->table->name ?? '--', false); ?><br>
						<strong><?php echo app('translator')->get('restaurant.booking_starts'); ?>:</strong> <?php echo e($booking_start, false); ?><br>
						<strong><?php echo app('translator')->get('restaurant.booking_ends'); ?>:</strong> <?php echo e($booking_end, false); ?>

					</div>
				</div>
				<br>
				<hr>
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="button" class="btn btn-primary btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\BookingController::class, 'edit'], [$booking->id]), false); ?>" data-container=".view_modal">
							<i class="fa fa-pencil"></i> <?php echo app('translator')->get('restaurant.edit_booking'); ?>
						</button>
						<button type="button" class="btn btn-info btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], ['transaction_id' => $booking->id,'template_for' => 'new_booking']), false); ?>" data-container=".view_modal"><?php echo app('translator')->get('restaurant.send_notification_to_customer'); ?></button>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-9">
						<?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\BookingController::class, 'update'], [$booking->id]), 'method' => 'PUT', 'id' => 'edit_booking_form' ]); ?>

							<div class="input-group">
				                <?php echo Form::select('booking_status', $booking_statuses, $booking->booking_status, ['class' => 'form-control', 'placeholder' => __('restaurant.change_booking_status'), 'required']); ?>

				                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
				             </div>
						<?php echo Form::close(); ?>

					</div>
					<div class="col-sm-3 text-center">
						<button type="button" class="btn btn-danger" id="delete_booking" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\BookingController::class, 'destroy'], [$booking->id]), false); ?>"><?php echo app('translator')->get('restaurant.delete_booking'); ?></button>
					</div>
				</div>
			<br>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>
		

	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
