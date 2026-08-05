<div class="modal-dialog" role="document">
	<div class="modal-content">

	<?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\BookingController::class, 'store']), 'method' => 'post', 'id' => 'sell_booking_form' ]); ?>

		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><i class="fa fa-calendar"></i> <?php echo app('translator')->get('restaurant.add_booking_reminder'); ?></h4>
		</div>

		<div class="modal-body">
			<input type="hidden" id="user_id" value="<?php echo e(auth()->user()->id, false); ?>">
			<div class="row">
				<div class="col-sm-12">
					<div class="mb-3">
						<?php echo Form::label('location_id', __('purchase.business_location') . ':*'); ?>

						<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control', 'required', 'id' => 'sell_booking_location_id', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('contact_id', __('contact.customer') . ':'); ?>

						<?php echo Form::select('contact_id', $customers, $default_contact, ['class' => 'form-control', 'id' => 'sell_booking_customer_id', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('correspondent', __('restaurant.correspondent') . ':'); ?>

						<?php echo Form::select('correspondent', $correspondents, null, ['class' => 'form-control', 'placeholder' => __('restaurant.select_correspondent'), 'id' => 'sell_booking_correspondent', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<?php if(count($commission_agents) > 0): ?>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('commission_agent_id', __('lang_v1.commission_agent') . ':'); ?>

						<?php echo Form::select('commission_agent_id', $commission_agents, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.commission_agent'), 'id' => 'sell_booking_commission_agent', 'style' => 'width: 100%;']); ?>

					</div>
				</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div id="sell_booking_table_span"></div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('booking_start', __('restaurant.start_time') . ':*'); ?>

						<div class='input-group date'>
							<span class="input-group-text">
								<span class="fa fa-calendar"></span>
							</span>
							<?php echo Form::text('booking_start', null, ['class' => 'form-control','placeholder' => __('restaurant.start_time'), 'required', 'id' => 'sell_booking_start_time', 'readonly']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="mb-3">
						<?php echo Form::label('booking_end', __('restaurant.end_time') . ':*'); ?>

						<div class='input-group date'>
							<span class="input-group-text">
								<span class="fa fa-calendar"></span>
							</span>
							<?php echo Form::text('booking_end', null, ['class' => 'form-control','placeholder' => __('restaurant.end_time'), 'required', 'id' => 'sell_booking_end_time', 'readonly']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="mb-3">
						<?php echo Form::label('booking_note', __('restaurant.customer_note') . ':'); ?>

						<?php echo Form::textarea('booking_note', $booking_note, ['class' => 'form-control','placeholder' => __('restaurant.customer_note'), 'rows' => 3, 'id' => 'sell_booking_note']); ?>

					</div>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
		</div>

	<?php echo Form::close(); ?>


	</div><!-- /.modal-content -->
</div>
