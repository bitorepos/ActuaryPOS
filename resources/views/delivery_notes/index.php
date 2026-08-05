
<?php $__env->startSection('title', 'Delivery Notes'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1>Delivery Notes</h1>
</section>

<!-- Main content -->
<section class="content no-print">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'All Delivery Notes']); ?>
        <?php $__env->slot('tool'); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delivery_note.create')): ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\DeliveryNoteController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
            </div>
            <?php endif; ?>
        <?php $__env->endSlot(); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="delivery_notes_table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Date</th>
                    <th>Delivery Note No.</th>
                    <th>Invoice No.</th>
                    <th>Customer Name</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var delivery_notes_table = $('#delivery_notes_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/delivery-notes',
        columns: [
            { data: 'action', name: 'action', searchable: false, orderable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'delivery_note_no', name: 'delivery_note_no' },
            { data: 'invoice_no', name: 't.invoice_no' },
            { data: 'customer_name', name: 'c.name' },
            { data: 'status', name: 'status' }
        ]
    });

    $(document).on('click', 'a.delete-delivery-note', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            delivery_notes_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>