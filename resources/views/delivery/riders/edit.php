<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open([
            'url'    => action([\App\Http\Controllers\DeliveryManagementController::class, 'ridersUpdate'], [$rider->id]),
            'method' => 'put',
            'id'     => 'rider_edit_form',
            'files'  => true,
        ]); ?>


        <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Rider — <?php echo e(optional($rider->user)->first_name, false); ?> <?php echo e(optional($rider->user)->last_name, false); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('location_id', 'Base Location :'); ?>

                    <?php echo Form::select('location_id', $locations, $rider->location_id, ['class' => 'form-select select2', 'placeholder' => 'Select location']); ?>

                </div>
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('vehicle_type', 'Vehicle Type :*'); ?>

                    <?php echo Form::select('vehicle_type', $vehicle_types, $rider->vehicle_type, ['class' => 'form-select', 'required']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('vehicle_plate', 'Vehicle Plate :'); ?>

                    <?php echo Form::text('vehicle_plate', $rider->vehicle_plate, ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('vehicle_color', 'Vehicle Color :'); ?>

                    <?php echo Form::text('vehicle_color', $rider->vehicle_color, ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('license_no', 'Licence No :'); ?>

                    <?php echo Form::text('license_no', $rider->license_no, ['class' => 'form-control']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('license_expiry', 'Licence Expiry :'); ?>

                    <?php echo Form::date('license_expiry', optional($rider->license_expiry)->format('Y-m-d'), ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('emergency_contact', 'Emergency Contact :'); ?>

                    <?php echo Form::text('emergency_contact', $rider->emergency_contact, ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('max_load_kg', 'Max Load (kg) :'); ?>

                    <?php echo Form::number('max_load_kg', $rider->max_load_kg, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('base_fee', 'Base Delivery Fee :'); ?>

                    <?php echo Form::number('base_fee', $rider->base_fee, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('per_km_rate', 'Per Km Rate :'); ?>

                    <?php echo Form::number('per_km_rate', $rider->per_km_rate, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('status', 'Status :'); ?>

                    <?php echo Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive', 'suspended' => 'Suspended'], $rider->status, ['class' => 'form-select']); ?>

                </div>

                <div class="col-md-6 mb-2">
                    <?php echo Form::label('photo', 'Replace Photo :'); ?>

                    <?php echo Form::file('photo', ['class' => 'form-control', 'accept' => 'image/*']); ?>

                    <?php if($rider->photo): ?>
                        <div class="mt-1"><img src="<?php echo e(asset('storage/'.$rider->photo), false); ?>" style="max-height:60px;border-radius:8px;"></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('notes', 'Notes :'); ?>

                    <?php echo Form::textarea('notes', $rider->notes, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.update'); ?></button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
