<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <?php echo Form::open([
            'url'    => action([\App\Http\Controllers\DeliveryManagementController::class, 'assignmentStore']),
            'method' => 'post',
            'id'     => 'assignment_form',
        ]); ?>


        <div class="modal-header">
            <h4 class="modal-title"><i class="fa fa-route"></i> New Delivery Assignment</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Sale / Invoice (optional)</label>
                    <select name="transaction_id" id="ta_transaction" class="form-select" style="width:100%;"></select>
                    <small class="text-muted">Leave blank for direct delivery without a sale.</small>
                </div>
                <div class="col-md-6">
                    <label>Customer :*</label>
                    <select name="contact_id" id="ta_contact" class="form-select" style="width:100%;" required></select>
                </div>

                <div class="col-md-6">
                    <label>Assign Rider :*</label>
                    <?php echo Form::select('rider_id', $riders, null, ['class' => 'form-select select2', 'required', 'placeholder' => 'Select rider']); ?>

                </div>
                <div class="col-md-3">
                    <label>Priority</label>
                    <?php echo Form::select('priority', ['low' => 'Low', 'normal' => 'Normal', 'high' => 'High', 'urgent' => 'Urgent'], 'normal', ['class' => 'form-select']); ?>

                </div>
                <div class="col-md-3">
                    <label>Scheduled At</label>
                    <input type="datetime-local" name="scheduled_at" class="form-control">
                </div>

                <div class="col-md-12"><hr class="my-2"><strong>Pickup</strong></div>
                <div class="col-md-12">
                    <input type="text" name="pickup_address" id="ta_pickup_address" class="form-control" placeholder="Pickup address (search)">
                </div>
                <div class="col-md-6">
                    <input type="number" step="any" name="pickup_latitude" id="ta_pickup_lat" class="form-control" placeholder="Latitude">
                </div>
                <div class="col-md-6">
                    <input type="number" step="any" name="pickup_longitude" id="ta_pickup_lng" class="form-control" placeholder="Longitude">
                </div>

                <div class="col-md-12"><strong>Drop-off</strong></div>
                <div class="col-md-12">
                    <input type="text" name="dropoff_address" id="ta_dropoff_address" class="form-control" placeholder="Drop-off address (autofilled from customer)">
                </div>
                <div class="col-md-6">
                    <input type="number" step="any" name="dropoff_latitude" id="ta_dropoff_lat" class="form-control" placeholder="Latitude">
                </div>
                <div class="col-md-6">
                    <input type="number" step="any" name="dropoff_longitude" id="ta_dropoff_lng" class="form-control" placeholder="Longitude">
                </div>

                <div class="col-md-6">
                    <label>Delivery Fee (override)</label>
                    <input type="number" step="0.01" name="delivery_fee" class="form-control" placeholder="Auto-calculated if empty">
                </div>
                <div class="col-md-6">
                    <label>Notes</label>
                    <textarea name="notes" class="form-control" rows="2"></textarea>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Assign</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>

<script>
$(function () {
    function fillFromTx(item) {
        if (!item) return;
        if (item.position) {
            $('#ta_dropoff_lat').val(item.position.lat);
            $('#ta_dropoff_lng').val(item.position.lng);
        }
        if (item.shipping_address) $('#ta_dropoff_address').val(item.shipping_address);
        if (item.contact_id) {
            const opt = new Option(item.customer_name + (item.mobile ? ' ('+item.mobile+')' : ''), item.contact_id, true, true);
            $('#ta_contact').append(opt).trigger('change');
        }
    }

    $('#ta_transaction').select2({
        placeholder: 'Search invoice or customer…',
        allowClear: true,
        ajax: {
            url: '<?php echo e(url('/delivery/api/transactions'), false); ?>',
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: d => ({ results: d.results }),
        },
    }).on('select2:select', e => fillFromTx(e.params.data));

    $('#ta_contact').select2({
        placeholder: 'Search customer…',
        ajax: {
            url: '<?php echo e(url('/delivery/api/contacts'), false); ?>',
            dataType: 'json',
            delay: 250,
            data: params => ({ q: params.term }),
            processResults: d => ({ results: d.results }),
        },
    }).on('select2:select', e => {
        const item = e.params.data;
        if (item.position) {
            $('#ta_dropoff_lat').val(item.position.lat);
            $('#ta_dropoff_lng').val(item.position.lng);
        }
        if (item.shipping_address) $('#ta_dropoff_address').val(item.shipping_address);
    });
});
</script>
