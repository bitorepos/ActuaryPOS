
<?php $__env->startSection('title', __('gender.genders')); ?>

<?php $__env->startSection('content'); ?>
<style>
    .gender-parent-row {
        background-color: #f8f9fa !important;
    }
    .gender-parent-row td:first-child {
        font-weight: 600;
    }
    .tree-parent .tree-toggle,
    .tree-child .tree-toggle {
        width: 16px;
        text-align: center;
        margin-right: 4px;
        color: #6c757d;
        transition: transform 0.2s ease;
        cursor: pointer;
    }
    .tree-toggle.collapsed {
        transform: rotate(-90deg);
    }
    .tree-child .tree-indent {
        margin-right: 6px;
        color: #adb5bd;
    }
    .gender-child-row.tree-collapsed {
        display: none;
    }
    .btn-tree-toggle-all {
        margin-left: 8px;
        font-size: 12px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'gender.genders' ); ?>
        <small><?php echo app('translator')->get( 'gender.manage_your_genders' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'gender.all_your_genders' )]); ?>
        <?php if(!$is_offline): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gender.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\GenderController::class, 'create']), false); ?>" 
                        data-container=".genders_modal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_genders">
                    <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                </button>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('gender.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="genders_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'gender.genders' ); ?></th>
                            <th><?php echo app('translator')->get( 'gender.note' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade genders_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){
        var expandAllText = "<?php echo app('translator')->get('lang_v1.expand_all'); ?>";
        var collapseAllText = "<?php echo app('translator')->get('lang_v1.collapse_all'); ?>";

        function collapseAllGenderChildren() {
            $('#genders_table tbody tr.gender-child-row').addClass('tree-collapsed').hide();
            $('#genders_table tbody tr.gender-parent-row .tree-toggle').addClass('collapsed');
            $('#toggle_all_genders').html('<i class="fa fa-expand"></i> ' + expandAllText);
            $('#toggle_all_genders').data('collapsed', true);
        }

        function expandAllGenderChildren() {
            $('#genders_table tbody tr.gender-child-row').removeClass('tree-collapsed').show();
            $('#genders_table tbody tr.gender-parent-row .tree-toggle').removeClass('collapsed');
            $('#toggle_all_genders').html('<i class="fa fa-compress"></i> ' + collapseAllText);
            $('#toggle_all_genders').data('collapsed', false);
        }

        var genders_table = $('#genders_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/genders',
                data: function(d) {
                    d.show_deleted = $('#show_deleted').is(':checked');
                }
            },
            columnDefs: [
                {
                    targets: 2,
                    orderable: false,
                    searchable: false,
                },
            ],
            columns: [
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action' },
            ],
            drawCallback: function() {
                collapseAllGenderChildren();
            },
        });

        $('#show_deleted').on('change', function(){
            genders_table.ajax.reload();
        });

        $(document).on('click', '#genders_table .tree-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $toggle = $(this);
            var $parentRow = $toggle.closest('tr');
            var parentId = $parentRow.attr('data-item-id');
            var $childRows = $('#genders_table tbody tr.gender-child-row[data-parent-id="' + parentId + '"]');
            var isCollapsed = $toggle.hasClass('collapsed');

            if (isCollapsed) {
                $toggle.removeClass('collapsed');
                $childRows.removeClass('tree-collapsed').show();
            } else {
                $toggle.addClass('collapsed');
                $childRows.addClass('tree-collapsed').hide();
            }
        });

        $(document).on('click', '#toggle_all_genders', function() {
            var isCollapsed = $(this).data('collapsed') === true;
            if (isCollapsed) {
                expandAllGenderChildren();
            } else {
                collapseAllGenderChildren();
            }
        });

        $(document).on('submit', 'form#gender_add_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div.genders_modal').modal('hide');
                        toastr.success(result.msg);
                        genders_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        $(document).on('submit', 'form#gender_edit_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div.genders_modal').modal('hide');
                        toastr.success(result.msg);
                        genders_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        $(document).on('click', 'button.edit_gender_button', function() {
            $('div.genders_modal').load($(this).data('href'), function() {
                $(this).modal('show');
                $('form#gender_edit_form').find('.select2').each(function() {
                    __select2($(this));
                });
            });
        });

        $(document).on('click', 'button.delete_gender_button', function() {
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
                                genders_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button.restore_gender_button', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
            }).then(willRestore => {
                if (willRestore) {
                    var href = $(this).data('href');
                    $.ajax({
                        method: 'GET',
                        url: href,
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                genders_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('submit', 'form#quick_add_gender_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        var gender_id = result.data.id;
                        var gender_name = result.data.name;
                        if ($('#gender_id').length) {
                            $('#gender_id').append($('<option>', { value: gender_id, text: gender_name }));
                            $('#gender_id').val(gender_id).change();
                        }
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>