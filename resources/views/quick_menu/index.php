
<?php $__env->startSection('title', __( 'business.quick_menu' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'business.quick_menu' ); ?>
        <small><?php echo app('translator')->get( 'business.manage_quick_menus' ); ?></small>
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
        	<h3 class="box-title"><?php echo app('translator')->get( 'business.all_quick_menus' ); ?></h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_quick_menu')): ?>
            	<div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                    	data-href="<?php echo e(action([\App\Http\Controllers\QuickMenuController::class, 'create']), false); ?>" 
                    	data-container=".quick_menu_modal">
                    	<i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <br>
                        <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                        </label>
                    </div>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_quick_menu')): ?>
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-th-skin" id="quick_menu_table">
            		<thead>
            			<tr>
            				<th>Name</th>
                            <th>No of Menu</th>
                            <th>No of Menu Items</th>
                            <th><?php echo app('translator')->get('business.day_of_week'); ?></th>
                            <th><?php echo app('translator')->get( 'purchase.business_location' ); ?></th>
            				<th>Created By</th>
            				<th><?php echo app('translator')->get( 'messages.action' ); ?></th>
            			</tr>
            		</thead>
            	</table>           
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade quick_menu_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('submit', 'form#quick_menu_add_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            $('div.quick_menu_modal').modal('hide');
                            toastr.success(result.msg);
                            quick_menu_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //Brands table
            var quick_menu_table = $('#quick_menu_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/quick-menus",
                        "data": function(d) {
                        d.show_deleted = $('#show_deleted').is(':checked');
                    }},
                    columnDefs: [ {
                        "targets": 4,
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'name', name: 'name'  },
                        { data: 'no_of_menu', name: 'no_of_menu' },
                        { data: 'no_of_menu_items', name: 'no_of_menu_items' },
                        { data: 'day_of_week', name: 'day_of_week', render: function(data) { return data ? data.charAt(0).toUpperCase() + data.slice(1) : '-'; } },
                        { data: 'location', name: 'BL.name'},
                        { data: 'created_by', name: 'created_by'},
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_quick_menu_button', function(){
                var $modal = $( "div.quick_menu_modal" );
                if (!$modal.parent().is('body')) {
                    $modal.appendTo('body');
                }
                $modal.load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#table_edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.quick_menu_modal').modal('hide');
                                    toastr.success(result.msg);
                                    quick_menu_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_quick_menu_button', function(){
                swal({
                  title: LANG.sure,
                  text: LANG.confirm_delete_table,
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
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    quick_menu_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
            $(document).on('click', 'button.restore_quick_menu_button', function(){
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willRestore) => {
                    if (willRestore) {
                        var href = $(this).data('href');
                        var data = $(this).serialize();

                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    quick_menu_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('change', 'input#show_deleted', function(e) {
                quick_menu_table.ajax.reload();
            });


            $(document).on('change', 'select#copy_from', function() {
                var selectedOption = $(this).find('option:selected');
                if (selectedOption.val()) {
                    $('.quick_menu_modal #no_of_menu').val(selectedOption.data('no_of_menu'));
                    $('.quick_menu_modal #no_of_menu_items').val(selectedOption.data('no_of_menu_items'));
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>