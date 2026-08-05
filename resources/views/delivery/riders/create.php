<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open([
            'url' => action([\App\Http\Controllers\DeliveryManagementController::class, 'ridersStore']),
            'method' => 'post',
            'id'    => 'rider_form',
            'files' => true,
        ]); ?>


        <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-motorcycle"></i> Add Delivery Rider</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <div class="alert alert-info py-2">
                <i class="fa fa-info-circle"></i> Riders are picked from <strong>Sales Commission Agents</strong>.
                Add a person to that list first if missing.
            </div>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('user_id', 'Commission Agent (Rider) :*'); ?>

                    <?php echo Form::select('user_id', $agents, null, ['class' => 'form-select select2', 'required', 'placeholder' => 'Select agent']); ?>

                </div>
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('location_id', 'Base Location :'); ?>

                    <?php echo Form::select('location_id', $locations, null, ['class' => 'form-select select2', 'placeholder' => 'Select location']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('vehicle_type', 'Vehicle Type :*'); ?>

                    <?php echo Form::select('vehicle_type', $vehicle_types, 'motorbike', ['class' => 'form-select', 'required']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('vehicle_plate', 'Vehicle Plate :'); ?>

                    <?php echo Form::text('vehicle_plate', null, ['class' => 'form-control', 'placeholder' => 'e.g. ABC-123']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('vehicle_color', 'Vehicle Color :'); ?>

                    <?php echo Form::text('vehicle_color', null, ['class' => 'form-control']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('license_no', 'Driving Licence No :'); ?>

                    <?php echo Form::text('license_no', null, ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('license_expiry', 'Licence Expiry :'); ?>

                    <?php echo Form::date('license_expiry', null, ['class' => 'form-control']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('emergency_contact', 'Emergency Contact :'); ?>

                    <?php echo Form::text('emergency_contact', null, ['class' => 'form-control']); ?>

                </div>

                <div class="col-md-4 mb-2">
                    <?php echo Form::label('max_load_kg', 'Max Load (kg) :'); ?>

                    <?php echo Form::number('max_load_kg', null, ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('base_fee', 'Base Delivery Fee :'); ?>

                    <?php echo Form::number('base_fee', '0', ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>
                <div class="col-md-4 mb-2">
                    <?php echo Form::label('per_km_rate', 'Per Km Rate :'); ?>

                    <?php echo Form::number('per_km_rate', '0', ['class' => 'form-control', 'step' => '0.01']); ?>

                </div>

                <div class="col-md-6 mb-2">
                    <?php echo Form::label('status', 'Status :'); ?>

                    <?php echo Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive', 'suspended' => 'Suspended'], 'active', ['class' => 'form-select']); ?>

                </div>
                <div class="col-md-6 mb-2">
                    <?php echo Form::label('photo', 'Photo :'); ?>

                    <?php echo Form::file('photo', ['class' => 'form-control', 'accept' => 'image/*']); ?>

                </div>

                <div class="col-md-12 mb-2">
                    <?php echo Form::label('notes', 'Notes :'); ?>

                    <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>
