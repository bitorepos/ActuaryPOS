
<?php $__env->startSection('title', __('printer.printers')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('printer.printers'); ?>
        <small><?php echo app('translator')->get('printer.manage_your_printers'); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('printer.all_your_printer')]); ?>
    <?php $__env->slot('tool'); ?>
    <div class="box-tools">
        <a class="btn btn-block btn-primary"
            href="<?php echo e(action([\App\Http\Controllers\PrinterController::class, 'create']), false); ?>">
            <i class="fa fa-plus"></i> <?php echo app('translator')->get('printer.add_printer'); ?></a>
    </div>
    <?php $__env->endSlot(); ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-th-skin" id="printer_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('printer.name'); ?></th>
                    <th><?php echo app('translator')->get('printer.connection_type'); ?></th>
                    <th><?php echo app('translator')->get('printer.capability_profile'); ?></th>
                    <th><?php echo app('translator')->get('printer.character_per_line'); ?></th>
                    <th><?php echo app('translator')->get('printer.ip_address'); ?></th>
                    <th><?php echo app('translator')->get('printer.port'); ?></th>
                    <th><?php echo app('translator')->get('printer.path'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm-4">
            <a href="<?php echo e(asset('files/pos_print_server.zip'), false); ?>" class="btn btn-success" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_pos_print_server'); ?></a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo e(asset('files/laragon-wamp.exe'), false); ?>" class="btn btn-success" download><i class="fa fa-download"></i> Download Laragon</a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo e(asset('files/php_imagick.exe'), false); ?>" class="btn btn-success" download><i class="fa fa-download"></i> Download PHP Imagick</a>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    var printer_table = $('#printer_table').DataTable({
        processing: true,
        serverSide: true,
        buttons: [],
        ajax: '/printers',
        bPaginate: false,
        columnDefs: [{
            "targets": 2,
            "orderable": false,
            "searchable": false
        }],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'connection_type', name: 'connection_type' },
            { data: 'capability_profile', name: 'capability_profile'},
            { data: 'char_per_line', name: 'char_per_line' },
            { data: 'ip_address', name: 'ip_address' },
            { data: 'port', name: 'port' },
            { data: 'path', name: 'path' },
            { data: 'action', name: 'action' },
        ]
    });
    $(document).on('click', 'button.delete_printer_button', function() {
        swal({
            title: LANG.sure,
            text: LANG.confirm_delete_printer,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: "DELETE",
                    url: href,
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            printer_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            }
        });
    });
    $(document).on('click', 'button.set_default', function() {
        var href = $(this).data('href');
        var data = $(this).serialize();

        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            data: data,
            success: function(result) {
                if (result.success === true) {
                    toastr.success(result.msg);
                    printer_table.ajax.reload();
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