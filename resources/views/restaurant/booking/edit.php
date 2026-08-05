<div class="modal-dialog" role="document">
	<div class="modal-content">

	<?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\BookingController::class, 'update'], [$booking->id]), 'method' => 'PUT', 'id' => 'edit_booking_details_form' ]); ?>

		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.edit_booking' ); ?></h4>
		</div>

		<div class="modal-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="mb-3">
						<?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

						<?php echo Form::select('location_id', $business_locations, $booking->location_id, ['class' => 'form-control', 'placeholder' => __('purchase.business_location'), 'required', 'id' => 'edit_booking_location_id', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('contact_id', __('contact.customer') . ':'); ?>

						<?php echo Form::select('contact_id', $customers, $booking->contact_id, ['class' => 'form-control', 'id' => 'edit_booking_customer_id', 'placeholder' => __('contact.customer'), 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('correspondent', __('restaurant.correspondent') . ':'); ?>

						<?php echo Form::select('correspondent', $correspondents, $booking->correspondent_id, ['class' => 'form-control', 'placeholder' => __('restaurant.select_correspondent'), 'id' => 'edit_correspondent', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<?php if(count($commission_agents) > 0): ?>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('commission_agent_id', __('lang_v1.commission_agent') . ':'); ?>

						<?php echo Form::select('commission_agent_id', $commission_agents, $booking->commission_agent_id, ['class' => 'form-control', 'placeholder' => __('lang_v1.commission_agent'), 'id' => 'edit_commission_agent', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div id="edit_restaurant_module_span">
					<?php if(!empty($tables) && count($tables) > 0): ?>
					<div class="col-sm-6">
						<div class="mb-3">
							<?php echo Form::label('res_table_id', __('restaurant.table') . ':'); ?>

							<?php echo Form::select('res_table_id', $tables, $booking->table_id, ['class' => 'form-control', 'placeholder' => __('restaurant.select_table')]); ?>

						</div>
					</div>
					<?php endif; ?>
					<?php if(!empty($waiters) && count($waiters) > 0): ?>
					<div class="col-sm-6">
						<div class="mb-3">
							<?php echo Form::label('res_waiter_id', __('restaurant.service_staff') . ':'); ?>

							<?php echo Form::select('res_waiter_id', $waiters, $booking->waiter_id, ['class' => 'form-control', 'placeholder' => __('restaurant.select_waiter')]); ?>

						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="mb-3">
					<?php echo Form::label('edit_start_time', __('restaurant.start_time') . ':*'); ?>

						<div class='input-group date'>
						<span class="input-group-text">
							<span class="fa fa-calendar"></span>
						</span>
						<?php echo Form::text('booking_start', $booking_start, ['class' => 'form-control','placeholder' => __( 'restaurant.start_time' ), 'required', 'id' => 'edit_start_time', 'readonly']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('edit_end_time', __('restaurant.end_time') . ':*'); ?>

						<div class='input-group date'>
						<span class="input-group-text">
							<span class="fa fa-calendar"></span>
						</span>
						<?php echo Form::text('booking_end', $booking_end, ['class' => 'form-control','placeholder' => __( 'restaurant.end_time' ), 'required', 'id' => 'edit_end_time', 'readonly']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('booking_status', __('restaurant.booking_status') . ':'); ?>

						<?php echo Form::select('booking_status', $booking_statuses, $booking->booking_status, ['class' => 'form-control', 'placeholder' => __('restaurant.change_booking_status'), 'required']); ?>

					</div>
				</div>
				<div class="col-sm-12">
					<div class="mb-3">
					<?php echo Form::label('booking_note', __( 'restaurant.customer_note' ) . ':'); ?>

					<?php echo Form::textarea('booking_note', $booking->booking_note, ['class' => 'form-control','placeholder' => __( 'restaurant.customer_note' ), 'rows' => 3 ]); ?>

					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		</div>

	<?php echo Form::close(); ?>


	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
