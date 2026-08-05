
<?php $__env->startSection('title', __('barcode.barcodes')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('barcode.barcodes'); ?>
        <small><?php echo app('translator')->get('barcode.manage_your_barcodes'); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">

	<div class="box box-primary">
        <div class="box-header">
        	<h3 class="box-title"><?php echo app('translator')->get('barcode.all_your_barcode'); ?></h3>
        	<div class="box-tools">
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\BarcodeController::class, 'create']), false); ?>">
				<i class="fa fa-plus"></i> <?php echo app('translator')->get('barcode.add_new_setting'); ?></a>
            </div>
        </div>
        <div class="box-body">
        	<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="barcode_table">
        		<thead>
        			<tr>
        				<th><?php echo app('translator')->get('barcode.setting_name'); ?></th>
						<th><?php echo app('translator')->get('barcode.setting_description'); ?></th>
						<th>Action</th>
        			</tr>
        		</thead>
        	</table>
</div>
        </div>
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function(){
        var barcode_table = $('#barcode_table').DataTable({
            processing: true,
            serverSide: true,
            buttons:[],
            ajax: '/barcodes',
            bPaginate: false,
            columnDefs: [ {
                "targets": 2,
                "orderable": false,
                "searchable": false
            } ]
        });
        $(document).on('click', 'button.delete_barcode_button', function(){
            var is_confirmed = confirm("<?php echo e(__('barcode.delete_confirm'), false); ?>");
            if(!is_confirmed){
                return;
            }

            var href = $(this).data('href');
            var data = $(this).serialize();

            $.ajax({
                method: "DELETE",
                url: href,
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success === true){
                        toastr.success(result.msg);
                        barcode_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                }
            });
        });
        $(document).on('click', 'button.set_default', function(){
            var href = $(this).data('href');
            var data = $(this).serialize();

            $.ajax({
                method: "get",
                url: href,
                dataType: "json",
                data: data,
                success: function(result){
                    if(result.success === true){
                        toastr.success(result.msg);
                        barcode_table.ajax.reload();
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