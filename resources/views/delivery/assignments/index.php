
<?php $__env->startSection('title', 'Delivery Assignments'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><i class="fa fa-clipboard-list"></i> Delivery Assignments</h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery.assign')): ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-primary btn-modal float-end"
                    data-href="<?php echo e(action([\App\Http\Controllers\DeliveryManagementController::class, 'assignmentCreate']), false); ?>"
                    data-container=".assignment_modal">
                    <i class="fa fa-plus"></i> New Assignment
                </button>
            </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <div class="row g-2 mb-2">
            <div class="col-md-3">
                <?php echo Form::label('flt_status', 'Status'); ?>

                <?php echo Form::select('flt_status', ['' => 'All'] + $statuses, null, ['class' => 'form-select form-select-sm', 'id' => 'flt_status']); ?>

            </div>
            <div class="col-md-3">
                <?php echo Form::label('flt_rider', 'Rider'); ?>

                <?php echo Form::select('flt_rider', ['' => 'All'] + $riders->toArray(), null, ['class' => 'form-select form-select-sm', 'id' => 'flt_rider']); ?>

            </div>
            <div class="col-md-3">
                <?php echo Form::label('flt_start', 'From'); ?>

                <input type="date" id="flt_start" class="form-control form-control-sm">
            </div>
            <div class="col-md-3">
                <?php echo Form::label('flt_end', 'To'); ?>

                <input type="date" id="flt_end" class="form-control form-control-sm">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="assignments_table" style="width:100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Rider</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Distance</th>
                        <th>Fee</th>
                        <th>Assigned</th>
                        <th>Delivered</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade assignment_modal" tabindex="-1" role="dialog"></div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(function () {
    const table = $('#assignments_table').DataTable({
        processing: true, serverSide: true,
        ajax: {
            url: '<?php echo e(action([\App\Http\Controllers\DeliveryManagementController::class, 'assignmentsIndex']), false); ?>',
            data: function (d) {
                d.status     = $('#flt_status').val();
                d.rider_id   = $('#flt_rider').val();
                d.start_date = $('#flt_start').val();
                d.end_date   = $('#flt_end').val();
            }
        },
        columns: [
            { data: 'id', name: 'delivery_assignments.id' },
            { data: 'invoice_no', name: 'transactions.invoice_no' },
            { data: 'customer_name', name: 'contacts.name' },
            { data: 'rider_name', name: 'rider_name', orderable:false },
            { data: 'status_badge', name: 'delivery_assignments.status' },
            { data: 'priority_badge', name: 'delivery_assignments.priority' },
            { data: 'distance_km', name: 'delivery_assignments.distance_km' },
            { data: 'delivery_fee', name: 'delivery_assignments.delivery_fee' },
            { data: 'assigned_at', name: 'delivery_assignments.assigned_at' },
            { data: 'delivered_at', name: 'delivery_assignments.delivered_at' },
            { data: 'action', orderable:false, searchable:false },
        ],
        order: [[0, 'desc']],
    });
    $('#flt_status, #flt_rider, #flt_start, #flt_end').on('change', () => table.ajax.reload());
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>