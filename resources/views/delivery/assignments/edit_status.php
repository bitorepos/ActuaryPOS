<div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php echo Form::open([
            'url'    => action([\App\Http\Controllers\DeliveryManagementController::class, 'assignmentUpdateStatus'], [$assignment->id]),
            'method' => 'post',
            'id'     => 'assignment_status_form',
        ]); ?>

        <div class="modal-header">
            <h4 class="modal-title">Update Status — #<?php echo e($assignment->id, false); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                <label>Status :*</label>
                <?php echo Form::select('status', $statuses, $assignment->status, ['class' => 'form-select', 'required']); ?>

            </div>
            <div class="mb-2">
                <label>Cancellation Reason (if cancelling)</label>
                <?php echo Form::text('cancellation_reason', null, ['class' => 'form-control']); ?>

            </div>
            <div class="mb-2">
                <label>Notes</label>
                <?php echo Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2]); ?>

            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
