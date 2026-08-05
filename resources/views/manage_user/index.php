
<?php $__env->startSection('title', __( 'user.users' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'user.users' ); ?>
        <small><?php echo app('translator')->get( 'user.manage_users' ); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters'), 'class' => 'box-solid']); ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('user_filter_location_id', __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('user_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('user_name_filter', __('business.username') . ' / ' . __('user.name') . ':'); ?>

                        <?php echo Form::text('user_name_filter', null, ['class' => 'form-control', 'id' => 'user_name_filter', 'placeholder' => __('business.username') . ' / ' . __('user.name')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('user_type_filter', __('lang_v1.type') . ':'); ?>

                        <?php echo Form::select('user_type_filter', ['' => __('lang_v1.all'), 'users' => 'Users', 'employees' => 'Employees'], null, ['class' => 'form-control select2', 'id' => 'user_type_filter', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if($is_essentials_enabled): ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('department_id', __('essentials::lang.department') . ':'); ?>

                        <?php echo Form::select('department_id', $departments, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('sub_department_id', __('essentials::lang.sub_department') . ':'); ?>

                        <?php echo Form::select('sub_department_id', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('designation_id', __('essentials::lang.designation') . ':'); ?>

                        <?php echo Form::select('designation_id', $designations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <?php
    $custom_labels = json_decode(session('business.custom_labels'), true);
    $user_custom_field1 = !empty($custom_labels['user']['custom_field_1']) ? $custom_labels['user']['custom_field_1'] : __('lang_v1.user_custom_field1');
    $user_custom_field2 = !empty($custom_labels['user']['custom_field_2']) ? $custom_labels['user']['custom_field_2'] : __('lang_v1.user_custom_field2');
    $user_custom_field3 = !empty($custom_labels['user']['custom_field_3']) ? $custom_labels['user']['custom_field_3'] : __('lang_v1.user_custom_field3');
    $user_custom_field4 = !empty($custom_labels['user']['custom_field_4']) ? $custom_labels['user']['custom_field_4'] : __('lang_v1.user_custom_field4');
    ?>

    <div id="users_widget">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'user.all_users' ) . ' ' . $user_quota['users']['used'] . '/' . $user_quota['users']['allowed']]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <a class="btn btn-block btn-primary" 
                    href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'create']), false); ?>" >
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="users_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                            <?php if($is_essentials_enabled): ?>
                            <th><?php echo app('translator')->get( 'user.user_id' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.username' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.id_proof_number' ); ?></th>
                            <?php else: ?>
                            <th><?php echo app('translator')->get( 'business.username' ); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get( 'user.name' ); ?> <?php if($is_essentials_enabled): ?> / <?php echo app('translator')->get( 'lang_v1.guardian_name' ); ?> / <?php echo app('translator')->get( 'lang_v1.blood_group' ); ?> <?php endif; ?></th>
                            <?php if($is_essentials_enabled): ?>
                            <th><?php echo app('translator')->get( 'essentials::lang.department' ); ?> / <?php echo app('translator')->get( 'essentials::lang.sub_department' ); ?> / <?php echo app('translator')->get( 'essentials::lang.designation' ); ?></th>
                            <th><?php echo e($user_custom_field2, false); ?> <br> <?php echo app('translator')->get( 'lang_v1.dob' ); ?> </th>
                            <th><?php echo app('translator')->get( 'lang_v1.current_address' ); ?> / <?php echo app('translator')->get( 'lang_v1.permanent_address' ); ?> </th>
                            <th><?php echo app('translator')->get( 'essentials::lang.salary' ); ?></th>
                            <th><?php echo e($user_custom_field3, false); ?><br> / <?php echo e($user_custom_field4, false); ?> </th>
                            <th><?php echo app('translator')->get('lang_v1.bank_details'); ?></th>
                            <?php endif; ?>
                            <?php if(!$is_essentials_enabled): ?>
                            <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>
    </div>

    <?php if($is_essentials_enabled): ?>
        <div id="employees_widget">
        <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => 'All Employees ' . $user_quota['employees']['used'] . '/' . $user_quota['employees']['allowed']]); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.create_employee')): ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <a class="btn btn-block btn-primary" 
                        href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'create']), false); ?>?type=employees" >
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                    </div>
                <?php $__env->endSlot(); ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="employees_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                <th><?php echo app('translator')->get( 'user.user_id' ); ?></th>
                                <th><?php echo app('translator')->get( 'user.name' ); ?> / <?php echo app('translator')->get( 'lang_v1.guardian_name' ); ?> / <?php echo app('translator')->get( 'lang_v1.blood_group' ); ?></th>
                                <th><?php echo app('translator')->get( 'essentials::lang.department' ); ?> / <?php echo app('translator')->get( 'essentials::lang.sub_department' ); ?> / <?php echo app('translator')->get( 'essentials::lang.designation' ); ?></th>
                                <th><?php echo e($user_custom_field2, false); ?> <br> <?php echo app('translator')->get( 'lang_v1.dob' ); ?> </th>
                                <th><?php echo app('translator')->get( 'lang_v1.current_address' ); ?> / <?php echo app('translator')->get( 'lang_v1.permanent_address' ); ?> </th>
                                <th><?php echo app('translator')->get( 'essentials::lang.salary' ); ?></th>
                                <th><?php echo e($user_custom_field3, false); ?><br> / <?php echo e($user_custom_field4, false); ?> </th>
                                <th><?php echo app('translator')->get('lang_v1.bank_details'); ?></th>
                                <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>
        </div>
    <?php endif; ?>

    <?php if($has_contact_logins): ?>
        <div id="merchants_widget">
        <?php $__env->startComponent('components.widget', ['class' => 'box-default', 'title' => 'All Merchants']); ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin" id="merchants_table">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                <th><?php echo app('translator')->get( 'business.username' ); ?></th>
                                <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                                <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                                <th><?php echo app('translator')->get( 'user.role' ); ?></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            <?php endif; ?>
        <?php echo $__env->renderComponent(); ?>
        </div>
    <?php endif; ?>

    <div class="modal fade user_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    //Roles table
    $(document).ready( function(){
        var users_table = $('#users_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/users",
                        "data": function(d) {
                        <?php if($is_essentials_enabled): ?>
                        d.type = 'users';
                        <?php else: ?>
                        d.type = $('#user_type_filter').val() === 'employees' ? 'employees' : 'users';
                        <?php endif; ?>
                        d.location_id = $('#user_filter_location_id').val();
                        d.user_name = $('#user_name_filter').val();
                        d.show_deleted = $('#show_deleted').is(':checked');
                        if ($('#department_id').length) {
                            d.department_id = $('#department_id').val();
                        }
                        if ($('#sub_department_id').length) {
                            d.sub_department_id = $('#sub_department_id').val();
                        }
                        if ($('#designation_id').length) {
                            d.designation_id = $('#designation_id').val();
                        }
                    }},
                    columnDefs: [ {
                        "targets": [0],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"action"},
                        <?php if($is_essentials_enabled): ?>
                        {"data":"id"},
                        {"data":"username"},
                        {"data":"id_proof_number"},
                        <?php else: ?> 
                        {"data":"username"},
                        <?php endif; ?>
                        {"data":"full_name"},
                        <?php if($is_essentials_enabled): ?>
                        { data: 'department', name: 'department', searchable : false, },
                        { data: 'nic', name: 'nic' },
                        { data: 'address', name: 'address' },
                        { data: 'salary', name: 'salary' },
                        { data: 'social_security', name: 'social_security' },
                        { data: 'bank_details', name: 'bank_details', searchable : false, },
                        <?php endif; ?>
                        <?php if(!$is_essentials_enabled): ?>
                        {"data":"email"},
                        <?php endif; ?>
                        {"data":"role"}
                    ]
                });

        <?php if($is_essentials_enabled): ?>
        var employees_table = $('#employees_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/users",
                        "data": function(d) {
                        d.type = 'employees';
                        d.location_id = $('#user_filter_location_id').val();
                        d.user_name = $('#user_name_filter').val();
                        if ($('#department_id').length) {
                            d.department_id = $('#department_id').val();
                        }
                        if ($('#sub_department_id').length) {
                            d.sub_department_id = $('#sub_department_id').val();
                        }
                        if ($('#designation_id').length) {
                            d.designation_id = $('#designation_id').val();
                        }
                    }},
                    columnDefs: [ {
                        "targets": [0],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"action"},
                        <?php if($is_essentials_enabled): ?>
                        {"data":"id"},
                        <?php endif; ?>
                        {"data":"full_name"},
                        <?php if($is_essentials_enabled): ?>
                        { data: 'department', name: 'department', searchable : false, },
                        { data: 'nic', name: 'nic' },
                        { data: 'address', name: 'address' },
                        { data: 'salary', name: 'salary' },
                        { data: 'social_security', name: 'social_security' },
                        { data: 'bank_details', name: 'bank_details', searchable : false, },
                        <?php endif; ?>
                        <?php if(!$is_essentials_enabled): ?>
                        {"data":"email"},
                        <?php endif; ?>
                        {"data":"role"}
                    ]
                });
        <?php endif; ?>

        <?php if($has_contact_logins): ?>
        var merchants_table = $('#merchants_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "ajax": {
                        "url": "/users",
                        "data": function(d) {
                        d.type = 'merchants';
                        d.location_id = $('#user_filter_location_id').val();
                        d.user_name = $('#user_name_filter').val();
                        d.show_deleted = $('#show_deleted').is(':checked');
                    }},
                    columnDefs: [ {
                        "targets": [0],
                        "orderable": false,
                        "searchable": false
                    } ],
                    "columns":[
                        {"data":"action"},
                        {"data":"username"},
                        {"data":"full_name"},
                        {"data":"email"},
                        {"data":"role"}
                    ]
                });
        <?php endif; ?>
        
        $(document).on('click', 'a.delete_user_button', function(){
            swal({
              title: LANG.sure,
              text: LANG.confirm_delete_user,
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
                                users_table.ajax.reload();
                                <?php if($is_essentials_enabled): ?>
                                employees_table.ajax.reload();
                                <?php endif; ?>
                                <?php if($has_contact_logins): ?>
                                merchants_table.ajax.reload();
                                <?php endif; ?>
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });

        $(document).on('click', 'button.restore_user_button', function(){
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
                                users_table.ajax.reload();
                                <?php if($is_essentials_enabled): ?>
                                employees_table.ajax.reload();
                                <?php endif; ?>
                                <?php if($has_contact_logins): ?>
                                merchants_table.ajax.reload();
                                <?php endif; ?>
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                }
             });
        });
        $(document).on('change', 'input#show_deleted', function(e) {
            users_table.ajax.reload();
            <?php if($has_contact_logins): ?>
            merchants_table.ajax.reload();
            <?php endif; ?>
        });

        function applyUserTypeFilter() {
            var selected_type = $('#user_type_filter').val();
            <?php if($is_essentials_enabled): ?>
            $('#users_widget').toggle(selected_type === '' || selected_type === 'users');
            $('#employees_widget').toggle(selected_type === '' || selected_type === 'employees');
            <?php else: ?>
            $('#users_widget').show();
            <?php endif; ?>
            <?php if($has_contact_logins): ?>
            $('#merchants_widget').toggle(selected_type === '');
            <?php endif; ?>
        }

        function reloadVisibleUserTables() {
            if ($('#users_widget').is(':visible')) {
                users_table.ajax.reload();
            }
            <?php if($is_essentials_enabled): ?>
            if ($('#employees_widget').is(':visible')) {
                employees_table.ajax.reload();
            }
            <?php endif; ?>
            <?php if($has_contact_logins): ?>
            if ($('#merchants_widget').is(':visible')) {
                merchants_table.ajax.reload();
            }
            <?php endif; ?>
        }

        $(document).on('change keyup', '#user_filter_location_id, #user_name_filter, #user_type_filter, #department_id, #sub_department_id, #designation_id', function() {
            applyUserTypeFilter();
            reloadVisibleUserTables();
        });

        $(document).on('change', '#department_id', function(){
            if($(this).val() !== '') {
                $.ajax({
                    url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
                    dataType: 'json',
                    success: function(result) {
                        $('#sub_department_id').select2('destroy')
                            .empty()
                            .select2({
                                data: result.sub_categories,
                            });
                            $('#sub_department_id').change();
                    },
                });
            }else{
                $('#sub_department_id').select2('destroy')
                            .empty()
                            .select2({
                                data: [{id: null, text: "All"}],
                            });
                            $('#sub_department_id').change();
            }
        });
        
    });
    
    
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>