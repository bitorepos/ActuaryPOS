<div class="modal fade" id="add_booking_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

		<?php echo Form::open(['url' => action([\App\Http\Controllers\Restaurant\BookingController::class, 'store']), 'method' => 'post', 'id' => 'add_booking_form' ]); ?>

			<div class="modal-header">
				<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo app('translator')->get( 'restaurant.add_booking' ); ?></h4>
				</div>

				<div class="modal-body">
					<?php if(count($business_locations) == 1): ?>
						<?php 
							$default_location = current(array_keys($business_locations->toArray())) 
						?>
					<?php else: ?>
						<?php $default_location = null; ?>
					<?php endif; ?>
					<input type="hidden" id="user_id" value="<?php echo e(auth()->user()->id, false); ?>">
					<div class="row">
					<div class="col-sm-12">
						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-map-marker"></i>
								</span>
								<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control', 'placeholder' => __('purchase.business_location'), 'required', 'id' => 'booking_location_id']); ?>

							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="col-sm-6">
						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-user"></i>
								</span>
								<?php echo Form::select('contact_id', 
									$customers, null, ['class' => 'form-control', 'id' => 'booking_customer_id', 'placeholder' => __('contact.customer')]); ?>

								<span class="input-group-btn">
									<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-user"></i>
								</span>
								<?php echo Form::select('correspondent', $correspondents, null, ['class' => 'form-control', 'placeholder' => __('restaurant.select_correspondent'), 'id' => 'correspondent']); ?>

							</div>
						</div>
					</div>
					<?php if(count($commission_agents) > 0): ?>
					<div class="col-sm-6">
						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text">
									<i class="fa fa-briefcase"></i>
								</span>
								<?php echo Form::select('commission_agent_id', $commission_agents, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.commission_agent'), 'id' => 'booking_commission_agent']); ?>

							</div>
						</div>
					</div>
					<?php endif; ?>
					<div class="clearfix"></div>
					<div id="restaurant_module_span"></div>
					<div class="clearfix"></div>
					<div class="col-sm-6">
						<div class="mb-3">
						<?php echo Form::label('status', __('restaurant.start_time') . ':*'); ?>

	            			<div class='input-group date' >
	            			<span class="input-group-text">
	                    		<span class="fa fa-calendar"></span>
	                		</span>
							<?php echo Form::text('booking_start', null, ['class' => 'form-control','placeholder' => __( 'restaurant.start_time' ), 'required', 'id' => 'start_time', 'readonly']); ?>

							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="mb-3">
							<?php echo Form::label('status', __('restaurant.end_time') . ':*'); ?>

	            			<div class='input-group date' >
	            			<span class="input-group-text">
	                    		<span class="fa fa-calendar"></span>
	                		</span>
							<?php echo Form::text('booking_end', null, ['class' => 'form-control','placeholder' => __( 'restaurant.end_time' ), 'required', 'id' => 'end_time', 'readonly']); ?>

							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="mb-3">
						<?php echo Form::label('booking_note', __( 'restaurant.customer_note' ) . ':'); ?>

						<?php echo Form::textarea('booking_note', null, ['class' => 'form-control','placeholder' => __( 'restaurant.customer_note' ), 'rows' => 3 ]); ?>

						</div>
					</div>
					<div class="col-sm-12">
						<div class="mb-3">
						<div class="form-check">
							<label class="form-check-label">
								<?php echo Form::checkbox('send_notification', 1, false, ['class' => 'form-check-input', 'id' => 'send_notification']); ?> <?php echo app('translator')->get('restaurant.send_notification_to_customer'); ?>
							</label>
						</div>
					</div>
				</div>
				</div>

				<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
				<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
			</div>

		<?php echo Form::close(); ?>


		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
