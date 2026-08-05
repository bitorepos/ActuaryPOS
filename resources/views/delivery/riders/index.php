
<?php $__env->startSection('title', 'Delivery Riders'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><i class="fa fa-motorcycle"></i> Delivery Riders</h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery.create')): ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-primary btn-modal float-end"
                    data-href="<?php echo e(action([\App\Http\Controllers\DeliveryManagementController::class, 'ridersCreate']), false); ?>"
                    data-container=".rider_modal">
                    <i class="fa fa-plus"></i> Add Rider
                </button>
            </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <div class="row mb-2">
            <div class="col-md-4">
                <label class="form-check-label">
                    <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted_riders']); ?>

                    <strong>Show Deleted</strong>
                </label>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="riders_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Vehicle</th>
                        <th>Plate</th>
                        <th>Status</th>
                        <th>Availability</th>
                        <th>Last Seen</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade rider_modal" tabindex="-1" role="dialog"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    var table = $('#riders_table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: '<?php echo e(action([\App\Http\Controllers\DeliveryManagementController::class, 'ridersIndex']), false); ?>',
            data: function (d) { d.show_deleted = $('#show_deleted_riders').is(':checked') ? 'true' : 'false'; }
        },
        columns: [
            { data: 'full_name', name: 'full_name' },
            { data: 'email', name: 'users.email' },
            { data: 'contact_no', name: 'users.contact_no' },
            { data: 'vehicle_type', name: 'delivery_riders.vehicle_type' },
            { data: 'vehicle_plate', name: 'delivery_riders.vehicle_plate' },
            { data: 'status_badge', name: 'delivery_riders.status', orderable:false },
            { data: 'availability_badge', name: 'delivery_riders.availability', orderable:false },
            { data: 'last_seen', name: 'delivery_riders.last_ping_at' },
            { data: 'action', name: 'action', orderable:false, searchable:false },
        ],
        order: [[7, 'desc']],
    });

    $('#show_deleted_riders').on('change', () => table.ajax.reload());

    $(document).on('click', '.delete_rider_button', function () {
        if (!confirm('Delete this rider?')) return;
        $.ajax({ url: $(this).data('href'), type: 'DELETE', dataType:'json',
            data: { _token: '<?php echo e(csrf_token(), false); ?>' },
            success: r => { toastr[r.success?'success':'error'](r.msg); table.ajax.reload(); }
        });
    });

    $(document).on('click', '.restore_rider_button', function () {
        $.get($(this).data('href'), r => { toastr[r.success?'success':'error'](r.msg); table.ajax.reload(); });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>