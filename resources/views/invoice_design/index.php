
<?php $__env->startSection('title', __('invoice_design.invoice_designs')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('invoice_design.invoice_designs'); ?>
        <small><?php echo app('translator')->get('invoice_design.manage_designs'); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('invoice_design.all_designs')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'create']), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('invoice_design.add_new_design'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="invoice_design_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('invoice_design.design_name'); ?></th>
                        <th><?php echo app('translator')->get('barcode.setting_description'); ?></th>
                        <th><?php echo app('translator')->get('invoice_design.paper_type'); ?></th>
                        <th><?php echo app('translator')->get('invoice_design.last_modified'); ?></th>
                        <th><?php echo app('translator')->get('messages.action'); ?></th>
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
    var dt = $('#invoice_design_table').DataTable({
        processing: true,
        serverSide: true,
        buttons: [],
        ajax: '/invoice-designs',
        columnDefs: [{ "targets": [4], "orderable": false, "searchable": false }],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'paper_type', name: 'paper_type' },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' },
        ],
    });

    $(document).on('click', 'button.delete_invoice_design_button', function() {
        swal({
            title: LANG.sure,
            text: "This design will be deleted. Are you sure?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var href = $(this).data('href');
                $.ajax({
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            dt.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

    $(document).on('click', 'button.duplicate_invoice_design_button', function() {
        var href = $(this).data('href');
        $.ajax({
            method: "POST",
            url: href,
            dataType: "json",
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);
                    dt.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('click', 'button.set_default_design', function() {
        var href = $(this).data('href');
        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);
                    dt.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>