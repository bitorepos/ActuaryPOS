
<?php $__env->startSection('title', __('label_design.label_designs')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('label_design.label_designs'); ?>
        <small><?php echo app('translator')->get('label_design.manage_label_designs'); ?></small>
    </h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('label_design.all_label_designs')]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\LabelDesignController::class, 'create']), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('label_design.add_new_design'); ?></a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="label_design_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('label_design.design_name'); ?></th>
                        <th><?php echo app('translator')->get('barcode.setting_description'); ?></th>
                        <th><?php echo app('translator')->get('label_design.dimensions'); ?></th>
                        <th><?php echo app('translator')->get('label_design.last_modified'); ?></th>
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
    var label_design_table = $('#label_design_table').DataTable({
        processing: true,
        serverSide: true,
        buttons: [],
        ajax: '/label-designs',
        columnDefs: [{
            "targets": [4],
            "orderable": false,
            "searchable": false
        }],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'dimensions', name: 'dimensions', searchable: false, orderable: false },
            { data: 'updated_at', name: 'updated_at' },
            { data: 'action', name: 'action' },
        ],
    });

    $(document).on('click', 'button.delete_label_design_button', function() {
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
                            label_design_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });

    $(document).on('click', 'button.duplicate_label_design_button', function() {
        var href = $(this).data('href');
        $.ajax({
            method: "POST",
            url: href,
            dataType: "json",
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);
                    label_design_table.ajax.reload();
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
                    label_design_table.ajax.reload();
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