
<?php $__env->startSection('title', __('product.product_notes')); ?>

<?php $__env->startSection('content'); ?>

<section class="content-header">
    <h1><?php echo app('translator')->get('product.product_notes'); ?></h1>
</section>

<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
        <?php echo Form::open(['id' => 'product_note_filter_form']); ?>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('product_note_product_filter', __('sale.product') . ':'); ?>

                        <?php echo Form::select('product_id', [], null, ['class' => 'form-control product-note-filter-select', 'id' => 'product_note_product_filter', 'style' => 'width:100%', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php echo Form::label('product_note_supplier_filter', __('purchase.supplier') . ':'); ?>

                        <?php echo Form::select('supplier_id', $suppliers, null, ['class' => 'form-control select2', 'id' => 'product_note_supplier_filter', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <?php echo Form::label('product_note_priority_filter', __('product.priority_status') . ':'); ?>

                        <?php echo Form::select('priority_status', $priority_statuses, null, ['class' => 'form-control select2', 'id' => 'product_note_priority_filter', 'style' => 'width:100%', 'placeholder' => __('messages.all')]); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <br>
                        <label>
                            <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'input-icheck', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                        </label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                        <button type="button" class="btn btn-default" id="product_note_filter_reset"><?php echo app('translator')->get('messages.reset'); ?></button>
                    </div>
                </div>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('product.all_product_notes')]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_note.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-primary btn-modal"
                        data-href="<?php echo e(action([\App\Http\Controllers\ProductNoteController::class, 'create']), false); ?>"
                        data-container=".view_modal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?>
                    </button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>

        <table class="table table-bordered table-striped table-th-skin" id="product_notes_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('sale.product'); ?></th>
                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                    <th><?php echo app('translator')->get('product.priority_status'); ?></th>
                    <th><?php echo app('translator')->get('product.note'); ?></th>
                    <th><?php echo app('translator')->get('business.created_by'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                    <th><?php echo app('translator')->get('messages.action'); ?></th>
                </tr>
            </thead>
        </table>
    <?php echo $__env->renderComponent(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var product_notes_table = $('#product_notes_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?php echo e(action([\App\Http\Controllers\ProductNoteController::class, 'index']), false); ?>",
                data: function(d) {
                    d.product_id = $('#product_note_product_filter').val();
                    d.supplier_id = $('#product_note_supplier_filter').val();
                    d.priority_status = $('#product_note_priority_filter').val();
                    d.show_deleted = $('#show_deleted').is(':checked');
                    d = __datatable_ajax_callback(d);
                }
            },
            columnDefs: [
                {
                    targets: 6,
                    orderable: false,
                    searchable: false
                }
            ],
            columns: [
                { data: 'product_name', name: 'products.name' },
                { data: 'sku', name: 'products.sku' },
                { data: 'priority_status', name: 'product_notes.priority_status' },
                { data: 'note', name: 'product_notes.note' },
                { data: 'created_by', name: 'users.username' },
                { data: 'created_at', name: 'product_notes.created_at' },
                { data: 'action', name: 'action' },
            ]
        });

        function initProductSelect($element, dropdownParent) {
            $element.select2({
                ajax: {
                    url: '/products/list-no-variation',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                },
                minimumInputLength: 1,
                dropdownParent: dropdownParent,
                escapeMarkup: function(m) {
                    return m;
                },
            });
        }

        initProductSelect($('.product-note-filter-select'), $(document.body));

        $(document).on('shown.bs.modal', '.view_modal', function() {
            var $modal = $(this);
            initProductSelect($modal.find('.product-note-product-select'), $modal);
            $modal.find('select.select2').not('.product-note-product-select, .select2-hidden-accessible').each(function() {
                $(this).select2({
                    dropdownParent: $modal
                });
            });
        });

        $(document).on('submit', '#product_note_filter_form', function(e) {
            e.preventDefault();
            product_notes_table.ajax.reload();
        });

        $(document).on('change ifChanged', '#product_note_supplier_filter, #product_note_priority_filter, #show_deleted', function() {
            product_notes_table.ajax.reload();
        });

        $(document).on('change', '#product_note_product_filter', function() {
            product_notes_table.ajax.reload();
        });

        $(document).on('click', '#product_note_filter_reset', function() {
            $('#product_note_product_filter').val(null).trigger('change');
            $('#product_note_supplier_filter').val(null).trigger('change');
            $('#product_note_priority_filter').val(null).trigger('change');
            $('#show_deleted').iCheck('uncheck');
            product_notes_table.ajax.reload();
        });

        $(document).on('submit', 'form#product_note_form', function(e) {
            e.preventDefault();

            var form = $(this);
            form.find('button[type="submit"]').attr('disabled', true);

            $.ajax({
                method: form.attr('method'),
                url: form.attr('action'),
                dataType: 'json',
                data: form.serialize(),
                success: function(result) {
                    form.find('button[type="submit"]').attr('disabled', false);

                    if (result.success == true) {
                        $('div.view_modal').modal('hide');
                        toastr.success(result.msg);
                        product_notes_table.ajax.reload();
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function(xhr) {
                    form.find('button[type="submit"]').attr('disabled', false);

                    if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        var firstError = errors[Object.keys(errors)[0]][0];
                        toastr.error(firstError);
                    } else {
                        toastr.error(<?php echo json_encode(__('messages.something_went_wrong'), 15, 512) ?>);
                    }
                }
            });
        });

        $(document).on('click', 'button.delete_product_note_button', function() {
            swal({
                title: LANG.sure,
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax({
                        method: 'DELETE',
                        url: $(this).data('href'),
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                product_notes_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });

        $(document).on('click', 'button.restore_product_note_button', function() {
            swal({
                title: LANG.sure,
                icon: 'info',
                buttons: true,
            }).then(willRestore => {
                if (willRestore) {
                    $.ajax({
                        method: 'GET',
                        url: $(this).data('href'),
                        dataType: 'json',
                        success: function(result) {
                            if (result.success == true) {
                                toastr.success(result.msg);
                                product_notes_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        },
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>