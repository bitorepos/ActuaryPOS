
<?php $__env->startSection('title', __('restaurant.modifiers')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'restaurant.modifier_sets' ); ?>
        <small><?php echo app('translator')->get( 'restaurant.manage_your_modifiers' ); ?></small>
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
        	<h3 class="box-title"><?php echo app('translator')->get( 'restaurant.all_your_modifiers' ); ?></h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant.create')): ?>
            	<div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                    	data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'create']), false); ?>" 
                    	data-container=".modifier_modal">
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
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('restaurant.view')): ?>
            	<div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="modifier_table">
            		<thead>
            			<tr>
            				<th><?php echo app('translator')->get( 'restaurant.modifier_sets' ); ?></th>
                            <th><?php echo app('translator')->get( 'restaurant.modifiers' ); ?></th>
                            <th><?php echo app('translator')->get( 'restaurant.products' ); ?></th>
            				<th><?php echo app('translator')->get( 'messages.action' ); ?></th>
            			</tr>
            		</thead>
            	</table>
</div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade modifier_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', 'button.remove-modifier-row', function(e){
                $(this).closest('tr').remove();
            });

            $(document).on('submit', 'form#table_add_form', function(e){
                e.preventDefault();
                var data = $(this).serialize();

                $.ajax({
                    method: "POST",
                    url: $(this).attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(result){
                        if(result.success == true){
                            $('div.modifier_modal').modal('hide');
                            toastr.success(result.msg);
                            modifier_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            //Brands table
            var modifier_table = $('#modifier_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/modules/modifiers",
                        "data": function(d) {
                        d.show_deleted = $('#show_deleted').is(':checked');
                    }},
                    columnDefs: [ {
                        "targets": [1,2, 3],
                        "orderable": false,
                        "searchable": false
                    } ],
                    columns: [
                        { data: 'name', name: 'name'  },
                        { data: 'variations', name: 'variations'},
                        { data: 'modifier_products', name: 'modifier_products'},
                        { data: 'action', name: 'action'}
                    ],
                });

            $(document).on('click', 'button.edit_modifier_button', function(){

                $( "div.modifier_modal" ).load( $(this).data('href'), function(){

                    $(this).modal('show');

                    $('form#edit_form').submit(function(e){
                        e.preventDefault();
                        var data = $(this).serialize();

                        $.ajax({
                            method: "POST",
                            url: $(this).attr("action"),
                            dataType: "json",
                            data: data,
                            success: function(result){
                                if(result.success == true){
                                    $('div.modifier_modal').modal('hide');
                                    toastr.success(result.msg);
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    });
                });
            });

            $(document).on('click', 'button.delete_modifier_button', function(){
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
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'button.restore_modifier_button', function(){
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
                                    modifier_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
            
            $(document).on('change', 'input#show_deleted', function(e) {
                modifier_table.ajax.reload();
            });
            $(document).on('click', 'button.add-modifier-row', function(){
                $('table#add-modifier-table').append($(this).data('html'));
            });

            $(document).on('click', 'button.remove_modifier_product', function(){
                swal({
                  title: LANG.sure,
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $(this).closest('tr').remove();
                    }
                });
            });
            
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>