
<?php $__env->startSection('title', __('lang_v1.payment_accounts')); ?>

<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.payment_accounts'); ?>
        <small><?php echo app('translator')->get('account.manage_your_account'); ?></small>
        <small class='text-danger'><?php echo app('translator')->get('lang_v1.accounting_warning'); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php if(!empty($not_linked_payments)): ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger">
                    <ul>
                        <?php if(!empty($not_linked_payments)): ?>
                            <li><?php echo __('account.payments_not_linked_with_account', ['payments' => $not_linked_payments]); ?> <a href="<?php echo e(action([\App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']), false); ?>"><?php echo app('translator')->get('account.view_details'); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account.access')): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item active" role="presentation">
                        <a href="#other_accounts" data-bs-toggle="tab" class="nav-link active pb-2 pe-2 ps-2" role="tab" aria-selected="true">
                            <i class="fa fa-book"></i> <strong><?php echo app('translator')->get('account.accounts'); ?></strong>
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a href="#account_types" data-bs-toggle="tab" class="nav-link pb-2 pe-2 ps-2" role="tab" aria-selected="false">
                            <i class="fa fa-list"></i> <strong>
                            <?php echo app('translator')->get('lang_v1.account_types'); ?> </strong>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="other_accounts" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <?php $__env->startComponent('components.widget'); ?>
                                    <div class="row">
                                    <div class="col-md-4">
                                        <?php echo Form::select('account_status', ['active' => __('business.is_active'), 'closed' => __('account.closed')], null, ['class' => 'form-control select2', 'style' => 'width:80%', 'id' => 'account_status']); ?>

                                    </div>
                                    <?php if(auth()->user()->can('account.add')): ?>
                                    <div class="col-md-4">
                                        <button type="button" class="btn btn-primary btn-modal float-end" 
                                            data-container=".account_model"
                                            data-href="<?php echo e(action([\App\Http\Controllers\AccountController::class, 'create']), false); ?>">
                                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                                    </div>
                                    </div>
                                    <?php endif; ?>
                                <?php echo $__env->renderComponent(); ?>
                            </div>
                            <div class="col-sm-12">
                            <br>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" id="other_account_table">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                                <th><?php echo app('translator')->get('account.account_number'); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.name' ); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.account_type' ); ?></th>
                                                <th><?php echo app('translator')->get( 'lang_v1.account_sub_type' ); ?></th>
                                                <th><?php echo app('translator')->get( 'brand.note' ); ?></th>
                                                <th class="text-right"><?php echo app('translator')->get('lang_v1.balance'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                                <th><?php echo app('translator')->get('lang_v1.account_details'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr class="bg-gray font-17 footer-total text-center">
                                                <td colspan="6"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                                <td class="footer_total_balance text-right"></td>
                                                <td colspan="3"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane" id="account_types" role="tabpanel">
                        <?php if(auth()->user()->can('account.add')): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-modal float-end" 
                                    data-href="<?php echo e(action([\App\Http\Controllers\AccountTypeController::class, 'create']), false); ?>"
                                    data-container="#account_type_modal">
                                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                            </div>
                        </div>
                        <?php endif; ?>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
<table class="table table-striped table-bordered" id="account_types_table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get( 'lang_v1.name' ); ?></th>
                                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $account_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="account_type_<?php echo e($account_type->id, false); ?>">
                                                <th><?php echo e($account_type->name, false); ?></th>
                                                <td>
                                                    <?php if(empty($account_type->deleted_at)): ?>
                                                    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountTypeController::class, 'destroy'], $account_type->id), 'method' => 'delete' ]); ?>

                                                    <?php if(auth()->user()->can('account.edit')): ?>
                                                    <button type="button" class="btn btn-primary btn-modal btn-sm" 
                                                    data-href="<?php echo e(action([\App\Http\Controllers\AccountTypeController::class, 'edit'], $account_type->id), false); ?>"
                                                    data-container="#account_type_modal">
                                                    
                                                    <i class="fa fa-edit"></i> <?php echo app('translator')->get( 'messages.edit' ); ?></button>
                                                    <?php endif; ?>
                                                    <?php if(auth()->user()->can('account.delete')): ?>
                                                    <button type="button" class="btn btn-danger btn-sm delete_account_type" >
                                                    <i class="fa fa-trash"></i> <?php echo app('translator')->get( 'messages.delete' ); ?></button>
                                                    <?php endif; ?>
                                                    <?php echo Form::close(); ?>

                                                    <?php else: ?>
                                                    <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountTypeController::class, 'restore'], $account_type->id), 'method' => 'get' ]); ?>

                                                    <button type="button" class="btn btn-warning btn-sm restore_account_type" >
                                                    <i class="fa fa-repeat"></i> <?php echo app('translator')->get( 'messages.restore' ); ?></button>
                                                    <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php $__currentLoopData = $account_type->sub_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>&nbsp;&nbsp;-- <?php echo e($sub_type->name, false); ?></td>
                                                    <td>
                                                        <?php if(empty($sub_type->deleted_at)): ?>
                                                        <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountTypeController::class, 'destroy'], $sub_type->id), 'method' => 'delete' ]); ?>

                                                            <?php if(auth()->user()->can('account.edit')): ?>
                                                            <button type="button" class="btn btn-primary btn-modal btn-sm" 
                                                        data-href="<?php echo e(action([\App\Http\Controllers\AccountTypeController::class, 'edit'], $sub_type->id), false); ?>"
                                                        data-container="#account_type_modal">
                                                        <i class="fa fa-edit"></i> <?php echo app('translator')->get( 'messages.edit' ); ?></button>
                                                        <?php endif; ?>
                                                            <?php if(auth()->user()->can('account.delete')): ?>
                                                            <button type="button" class="btn btn-danger btn-sm delete_account_type" >
                                                            <i class="fa fa-trash"></i> <?php echo app('translator')->get( 'messages.delete' ); ?></button>
                                                            <?php endif; ?>
                                                            <?php echo Form::close(); ?>

                                                        <?php else: ?>
                                                        <?php echo Form::open(['url' => action([\App\Http\Controllers\AccountTypeController::class, 'restore'], $sub_type->id), 'method' => 'get' ]); ?>

                                                            <button type="button" class="btn btn-warning btn-sm restore_account_type" >
                                                            <i class="fa fa-repeat"></i> <?php echo app('translator')->get( 'messages.restore' ); ?></button>
                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel" id="account_type_modal">
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){
        $('.nav-tabs-custom a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            var $active_tab = $(e.target);
            $active_tab.closest('ul.nav-tabs').find('li').removeClass('active');
            $active_tab.closest('li').addClass('active');
        });

        $(document).on('click', 'button.close_account', function(){
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                     var url = $(this).data('url');

                     $.ajax({
                         method: "get",
                         url: url,
                         dataType: "json",
                         success: function(result){
                             if(result.success == true){
                                toastr.success(result.msg);
                                capital_account_table.ajax.reload();
                                other_account_table.ajax.reload();
                             }else{
                                toastr.error(result.msg);
                            }

                        }
                    });
                }
            });
        });

        $(document).on('submit', 'form#edit_payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "POST",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        $(document).on('submit', 'form#payment_account_form', function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                method: "post",
                url: $(this).attr("action"),
                dataType: "json",
                data: data,
                success:function(result){
                    if(result.success == true){
                        $('div.account_model').modal('hide');
                        toastr.success(result.msg);
                        capital_account_table.ajax.reload();
                        other_account_table.ajax.reload();
                    }else{
                        toastr.error(result.msg);
                    }
                }
            });
        });

        // capital_account_table
        capital_account_table = $('#capital_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '/account/account?account_type=capital',
                        columnDefs:[{
                                "targets": 5,
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'account_number', name: 'account_number'},
                            {data: 'name', name: 'name'},
                            {data: 'note', name: 'note'},
                            {data: 'balance', name: 'balance', searchable: false, className: 'text-right'},
                            {data: 'action', name: 'action'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#capital_account_table'));
                        }
                    });
        // capital_account_table
        other_account_table = $('#other_account_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/account/account?account_type=other',
                            data: function(d){
                                d.account_status = $('#account_status').val();
                            }
                        },
                        columnDefs:[{
                                "targets": [0,7],
                                "orderable": false,
                                "searchable": false
                            }],
                        columns: [
                            {data: 'action', name: 'action'},
                            {data: 'account_number', name: 'accounts.account_number'},
                            {data: 'name', name: 'accounts.name'},
                            {data: 'parent_account_type_name', name: 'pat.name'},
                            {data: 'account_type_name', name: 'ats.name'},
                            {data: 'note', name: 'accounts.note'},
                            {data: 'balance', name: 'balance', searchable: false, className: 'text-right'},
                            {data: 'account_details', name: 'account_details'},
                            {data: 'added_by', name: 'u.first_name'},
                            {data: 'created_at', name: 'accounts.created_at'}
                        ],
                        "fnDrawCallback": function (oSettings) {
                            __currency_convert_recursively($('#other_account_table'));
                        },
                        "footerCallback": function ( row, data, start, end, display ) {
                            var footer_total_balance = 0;
                            for (var r in data){
                                footer_total_balance += $(data[r].balance).data('orig-value') ? parseFloat($(data[r].balance).data('orig-value')) : 0;
                            }
                            
                            $('.footer_total_balance').html(__currency_trans_from_en(footer_total_balance, false));
                        }
                    });

    });

    $('#account_status').change( function(){
        other_account_table.ajax.reload();
    });

    $(document).on('submit', 'form#deposit_form', function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
          method: "POST",
          url: $(this).attr("action"),
          dataType: "json",
          data: data,
          success: function(result){
            if(result.success == true){
              $('div.view_modal').modal('hide');
              toastr.success(result.msg);
              capital_account_table.ajax.reload();
              other_account_table.ajax.reload();
            } else {
              toastr.error(result.msg);
            }
          }
        });
    });

    $('.account_model').on('shown.bs.modal', function(e) {
        $('.account_model .select2').select2({ dropdownParent: $(this) })
    });

    $(document).on('click', 'button.delete_account_type', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete)=>{
            if(willDelete){
                $(this).closest('form').submit();
            }
        });
    })
    $(document).on('click', 'button.restore_account_type', function(){
        swal({
            title: LANG.sure,
            icon: "info",
            buttons: true,
        }).then((willRestore)=>{
            if(willRestore){
                $(this).closest('form').submit();
            }
        });
    })

    $(document).on('change', 'input#show_deleted', function(e) {
        other_account_tables.ajax.reload();
    });

    $(document).on('click', 'button.activate_account', function(){
        swal({
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willActivate)=>{
            if(willActivate){
                 var url = $(this).data('url');
                 $.ajax({
                     method: "get",
                     url: url,
                     dataType: "json",
                     success: function(result){
                         if(result.success == true){
                            toastr.success(result.msg);
                            capital_account_table.ajax.reload();
                            other_account_table.ajax.reload();
                         }else{
                            toastr.error(result.msg);
                        }

                    }
                });
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>