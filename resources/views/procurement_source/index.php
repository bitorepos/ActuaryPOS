
<?php $__env->startSection('title', __('procurement_source.procurement_sources')); ?>

<?php $__env->startSection('content'); ?>
<style>
    .procurement-source-parent-row {
        background-color: #f8f9fa !important;
    }
    .procurement-source-parent-row td:first-child {
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
    .procurement-source-child-row.tree-collapsed {
        display: none;
    }
    .btn-tree-toggle-all {
        margin-left: 8px;
        font-size: 12px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'procurement_source.procurement_sources' ); ?>
        <small><?php echo app('translator')->get( 'procurement_source.manage_your_procurement_sources' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'procurement_source.all_your_procurement_sources' )]); ?>
        <?php if(!$is_offline): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procurement_source.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\ProcurementSourceController::class, 'create']), false); ?>" 
                        data-container=".procurement_sources_modal">
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
                <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_procurement_sources">
                    <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                </button>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('procurement_source.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="procurement_sources_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'procurement_source.procurement_sources' ); ?></th>
                            <th><?php echo app('translator')->get( 'procurement_source.note' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade procurement_sources_modal" tabindex="-1" role="dialog" 
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

        function collapseAllProcurementSourceChildren() {
            $('#procurement_sources_table tbody tr.procurement-source-child-row').addClass('tree-collapsed').hide();
            $('#procurement_sources_table tbody tr.procurement-source-parent-row .tree-toggle').addClass('collapsed');
            $('#toggle_all_procurement_sources').html('<i class="fa fa-expand"></i> ' + expandAllText);
            $('#toggle_all_procurement_sources').data('collapsed', true);
        }

        function expandAllProcurementSourceChildren() {
            $('#procurement_sources_table tbody tr.procurement-source-child-row').removeClass('tree-collapsed').show();
            $('#procurement_sources_table tbody tr.procurement-source-parent-row .tree-toggle').removeClass('collapsed');
            $('#toggle_all_procurement_sources').html('<i class="fa fa-compress"></i> ' + collapseAllText);
            $('#toggle_all_procurement_sources').data('collapsed', false);
        }

        var procurement_sources_table = $('#procurement_sources_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/procurement-sources',
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
                collapseAllProcurementSourceChildren();
            },
        });

        $('#show_deleted').on('change', function(){
            procurement_sources_table.ajax.reload();
        });

        $(document).on('click', '#procurement_sources_table .tree-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var $toggle = $(this);
            var $parentRow = $toggle.closest('tr');
            var parentId = $parentRow.attr('data-item-id');
            var $childRows = $('#procurement_sources_table tbody tr.procurement-source-child-row[data-parent-id="' + parentId + '"]');
            var isCollapsed = $toggle.hasClass('collapsed');

            if (isCollapsed) {
                $toggle.removeClass('collapsed');
                $childRows.removeClass('tree-collapsed').show();
            } else {
                $toggle.addClass('collapsed');
                $childRows.addClass('tree-collapsed').hide();
            }
        });

        $(document).on('click', '#toggle_all_procurement_sources', function() {
            var isCollapsed = $(this).data('collapsed') === true;
            if (isCollapsed) {
                expandAllProcurementSourceChildren();
            } else {
                collapseAllProcurementSourceChildren();
            }
        });

        $(document).on('submit', 'form#procurement_source_add_form', function(e) {
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
                        $('div.procurement_sources_modal').modal('hide');
                        toastr.success(result.msg);
                        procurement_sources_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        $(document).on('submit', 'form#procurement_source_edit_form', function(e) {
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
                        $('div.procurement_sources_modal').modal('hide');
                        toastr.success(result.msg);
                        procurement_sources_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        $(document).on('click', 'button.edit_procurement_source_button', function() {
            $('div.procurement_sources_modal').load($(this).data('href'), function() {
                $(this).modal('show');
                $('form#procurement_source_edit_form').find('.select2').each(function() {
                    __select2($(this));
                });
            });
        });

        $(document).on('click', 'button.delete_procurement_source_button', function() {
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
                                procurement_sources_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button.restore_procurement_source_button', function() {
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
                                procurement_sources_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('submit', 'form#quick_add_procurement_source_form', function(e) {
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
                        var procurement_source_id = result.data.id;
                        var procurement_source_name = result.data.name;
                        if ($('#procurement_source_id').length) {
                            $('#procurement_source_id').append($('<option>', { value: procurement_source_id, text: procurement_source_name }));
                            $('#procurement_source_id').val(procurement_source_id).change();
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