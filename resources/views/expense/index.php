
<?php $__env->startSection('title', __('expense.expenses')); ?>

<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $selected_project_id = request()->get('pjt_project_id');
    $selected_project_step_id = request()->get('pjt_project_step_id');
    $initial_project_steps = [];

    if (! empty($selected_project_id) && ! empty($project_steps_by_project[$selected_project_id])) {
        foreach ($project_steps_by_project[$selected_project_id] as $project_step) {
            $initial_project_steps[$project_step['id']] = $project_step['text'];
        }
    }
?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('expense.expenses'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div clawss="row">
        
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <?php if(auth()->user()->can('all_expense.access')): ?>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                            <?php echo Form::select('location_id', $business_locations, request()->get('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_for', __('expense.expense_for').':'); ?>

                            <?php echo Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_contact_filter',  __('contact.contact') . ':'); ?>

                            <?php echo Form::select('expense_contact_filter', $contacts, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                        </div>
                    </div>
                    <?php if($truckmate_enabled): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('expense_job_filter',  __('truckmate::lang.jobs') . ':'); ?>

                            <?php echo Form::select('expense_job_filter', [], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'expense_job_filter']); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('expense_category_id',__('expense.expense_category').':'); ?>

                        <?php echo Form::select('expense_category_id', $categories, null, ['placeholder' =>
                        __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_category_id']); ?>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('expense_sub_category_id_filter',__('product.sub_category').':'); ?>

                        <?php echo Form::select('expense_sub_category_id_filter', $sub_categories, null, ['placeholder' =>
                        __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_sub_category_id_filter']); ?>

                    </div>
                </div>

                <?php if(isset($projects) && $projects->count()): ?>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_pjt_project_id', __('project::lang.project') . ':'); ?>

                            <?php echo Form::select('pjt_project_id', $projects, $selected_project_id, ['placeholder' => __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_pjt_project_id']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('expense_pjt_project_step_id', __('project::lang.project_step') . ':'); ?>

                            <?php echo Form::select('pjt_project_step_id', $initial_project_steps, $selected_project_step_id, ['placeholder' => __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_pjt_project_step_id']); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <br>
                            <label class="form-check-label">
                                <?php echo Form::checkbox('hide_project_expenses', 1, request()->boolean('hide_project_expenses'), ['class' => 'form-check-input', 'id' => 'hide_project_expenses']); ?> <strong><?php echo app('translator')->get('lang_v1.hide_projects_expenses'); ?></strong>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php
                            $date_loc = array_key_first($date_settings ?? []);
                            $expense_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
                                ? ($date_settings[$date_loc]['expense_filter_date_range'] ?? null)
                                : ($date_settings['expense_filter_date_range'] ?? null);
                        ?>
                        <?php if(!empty($expense_filter_date_range)): ?>
                            <?php echo Form::hidden('expense_filter_date_range', $expense_filter_date_range, ['id'=>'expense_filter_date_range']); ?>

                        <?php endif; ?>
                        <?php echo Form::label('expense_date_range', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly', 'data-start-date' => request()->get('start_date'), 'data-end-date' => request()->get('end_date')]); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('expense_payment_status',  __('purchase.payment_status') . ':'); ?>

                        <?php echo Form::select('expense_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], request()->get('payment_status'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('added_by', __('expense.added_by').':'); ?>

                        <?php echo Form::select('added_by', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <?php if(in_array('transactions_restoration', $enabled_modules)): ?>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <br>
                            <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                            </label>
                        </div>
                    </div>
                <?php endif; ?>
            <?php echo $__env->renderComponent(); ?>
        
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('expense.all_expenses')]); ?>
                <?php $__env->slot('tool'); ?>
                    <div class="box-tools">
                        <button type="button" class="btn btn-primary" id="expense_print_btn">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense.add')): ?>
                            <a class="btn btn-primary" href="<?php echo e(action([\App\Http\Controllers\ExpenseController::class, 'create']), false); ?>">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                        <?php endif; ?>
                    </div>
                <?php $__env->endSlot(); ?>
                <style>
                    .dataTables_scrollHead {
                        position: static !important;
                    }
                </style>
                <div class="table-responsive" style="overflow-x:auto; width:100%; max-width:100%;">
                    <table class="table table-bordered table-striped table-th-skin" id="expense_table" style="width:100%;">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('messages.action'); ?></th>
                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.recur_details'); ?></th>
                                <th><?php echo app('translator')->get('expense.expense_category'); ?></th>
                                <th><?php echo app('translator')->get('product.sub_category'); ?></th>
                                <th><?php echo app('translator')->get('business.location'); ?></th>
                                <th><?php echo app('translator')->get('project::lang.project'); ?></th>
                                <th><?php echo app('translator')->get('expense.expense_status'); ?></th>
                                <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                <th><?php echo app('translator')->get('product.tax'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('purchase.payment_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                                <th><?php echo app('translator')->get('expense.expense_for'); ?></th>
                                <th><?php echo app('translator')->get('contact.contact'); ?></th>
                                <?php if($truckmate_enabled): ?>
                                <th id="job_sheet_column"><?php echo app('translator')->get('truckmate::lang.jobs'); ?></th>
                                <?php endif; ?>
                                <th><?php echo app('translator')->get('expense.expense_note'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
                                <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr class="bg-gray font-17 text-center footer-total">
                                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="footer_status_count"></td>
                                <td class="footer_payment_status_count"></td>
                                <td class="footer_payment_method_count"></td>
                                <td></td>
                                <td class="footer_expense_total text-right"></td>
                                <td class="footer_total_due text-right"></td>
                                <td></td>
                                <td></td>
                                <?php if($truckmate_enabled): ?><td></td><?php endif; ?>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<!-- /.content -->
<!-- /.content -->

<?php echo $__env->make('expense.partials.update_expense_status_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
 <script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
 <script>
    $(document).ready(function() {
        if (typeof expense_table !== 'undefined') {
            <?php if(!empty($user_settings['expense_index_hide_ref_no'])): ?>
                expense_table.column(2).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_recur_details'])): ?>
                expense_table.column(3).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_expense_category'])): ?>
                expense_table.column(4).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_sub_category'])): ?>
                expense_table.column(5).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_location'])): ?>
                expense_table.column(6).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_payment_status'])): ?>
                expense_table.column(9).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_payment_method'])): ?>
                expense_table.column(10).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_tax'])): ?>
                expense_table.column(11).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_total_amount'])): ?>
                expense_table.column(12).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_payment_due'])): ?>
                expense_table.column(13).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_expense_for'])): ?>
                expense_table.column(14).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_contact'])): ?>
                expense_table.column(15).visible(false);
            <?php endif; ?>
            <?php
                $job_offset = $truckmate_enabled ? 1 : 0;
            ?>
            <?php if(!empty($user_settings['expense_index_hide_expense_note'])): ?>
                expense_table.column(<?php echo e(16 + $job_offset, false); ?>).visible(false);
            <?php endif; ?>
            <?php if(!empty($user_settings['expense_index_hide_added_by'])): ?>
                expense_table.column(<?php echo e(17 + $job_offset, false); ?>).visible(false);
            <?php endif; ?>
        }

        var expenseProjectStepsByProject = <?php echo json_encode($project_steps_by_project ?? [], 15, 512) ?>;
        var selectedExpenseProjectStep = <?php echo json_encode((string) $selected_project_step_id, 15, 512) ?>;
        var expenseProjectStepPlaceholder = <?php echo json_encode(__('report.all'), 15, 512) ?>;

        function refreshExpenseProjectStepFilter() {
            var $project = $('#expense_pjt_project_id');
            var $step = $('#expense_pjt_project_step_id');

            if (!$project.length || !$step.length) {
                return;
            }

            var projectId = String($project.val() || '');
            var steps = projectId && expenseProjectStepsByProject[projectId] ? expenseProjectStepsByProject[projectId] : [];
            var stepIsSelected = false;

            $step.empty().append(new Option(expenseProjectStepPlaceholder, ''));

            $.each(steps, function(i, step) {
                $step.append(new Option(step.text || step.name || '', step.id));

                if (selectedExpenseProjectStep && String(step.id) === String(selectedExpenseProjectStep)) {
                    stepIsSelected = true;
                }
            });

            $step.val(stepIsSelected ? selectedExpenseProjectStep : '');
            selectedExpenseProjectStep = '';

            if ($.fn.select2 && $step.hasClass('select2-hidden-accessible')) {
                $step.trigger('change.select2');
            }
        }

        function syncHideProjectExpenseFilters() {
            var hideProjectExpenses = $('#hide_project_expenses').is(':checked');
            var $project = $('#expense_pjt_project_id');
            var $step = $('#expense_pjt_project_step_id');

            if (!$project.length || !$step.length) {
                return;
            }

            if (hideProjectExpenses) {
                $project.val('').trigger('change.select2');
                $step.val('').trigger('change.select2');
            }

            $project.prop('disabled', hideProjectExpenses);
            $step.prop('disabled', hideProjectExpenses);

            if ($.fn.select2) {
                $project.trigger('change.select2');
                $step.trigger('change.select2');
            }
        }

        refreshExpenseProjectStepFilter();
        syncHideProjectExpenseFilters();

        $(document).on('change', '#expense_pjt_project_id', function() {
            refreshExpenseProjectStepFilter();
            if (typeof expense_table !== 'undefined') {
                expense_table.ajax.reload();
            }
        });

        $(document).on('change', '#hide_project_expenses', function() {
            syncHideProjectExpenseFilters();
            if (typeof expense_table !== 'undefined') {
                expense_table.ajax.reload();
            }
        });

        $(document).on('click', '.update_expense_status', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var status_link = $(this);
            $('#update_expense_status_form')
                .attr('action', status_link.data('href'))
                .data('status-link', status_link);
            $('#update_expense_status_form').find('#expense_status').val(status_link.data('status'));
            $('#update_expense_status_modal').modal('show');
        });

        function cleanExpenseStatusModal() {
            $('#update_expense_status_modal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        }

        $(document).on('hidden.bs.modal', '#update_expense_status_modal', function() {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        function updateExpenseStatusFromIndex() {
            var form = $('#update_expense_status_form');
            var submit_button = form.find('button[type="submit"]');
            if (!submit_button.length) {
                submit_button = $('#update_expense_status_btn');
            }
            var clear_processing = function() {
                $('.dataTables_processing').hide();
            };

            $.ajax({
                method: 'POST',
                url: form.attr('action'),
                headers: {
                    'Accept': 'application/json',
                },
                dataType: 'json',
                data: form.serialize(),
                beforeSend: function() {
                    submit_button.prop('disabled', true);
                },
                success: function(result) {
                    if (result.success == true) {
                        var status = form.find('#expense_status').val();
                        var label = form.find('#expense_status option:selected').text();
                        var status_link = form.data('status-link');

                        if (status_link && status_link.length) {
                            status_link
                                .data('status', status)
                                .data('orig-value', status)
                                .data('status-name', label)
                                .attr('data-status', status)
                                .attr('data-orig-value', status)
                                .attr('data-status-name', label);
                            status_link.find('.status-label')
                                .removeClass('bg-light-green bg-yellow')
                                .addClass(status == 'final' ? 'bg-light-green' : 'bg-yellow')
                                .attr('data-orig-value', status)
                                .attr('data-status-name', label)
                                .text(label);
                        }

                        cleanExpenseStatusModal();
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function() {
                    toastr.error(typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : '<?php echo e(__("messages.something_went_wrong"), false); ?>');
                },
                complete: function() {
                    submit_button.prop('disabled', false);
                    clear_processing();
                },
            });
        }

        $(document).on('click', '#update_expense_status_btn', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            updateExpenseStatusFromIndex();
        });

        $(document).on('submit', '#update_expense_status_form', function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            updateExpenseStatusFromIndex();
        });

        $('#expense_print_btn').on('click', function(e) {
            e.preventDefault();
            window.open("<?php echo e(route('expenses.print'), false); ?>?" + $.param(getExpensePrintParams()), '_blank');
        });

        function getExpensePrintParams() {
            var start = '';
            var end = '';
            if ($('#expense_date_range').val() && $('input#expense_date_range').data('daterangepicker')) {
                start = $('input#expense_date_range')
                    .data('daterangepicker')
                    .startDate.format('YYYY-MM-DD');
                end = $('input#expense_date_range')
                    .data('daterangepicker')
                    .endDate.format('YYYY-MM-DD');
            }

            return {
                expense_for: $('select#expense_for').val() || '',
                added_by: $('select#added_by').val() || '',
                contact_id: $('select#expense_contact_filter').val() || '',
                location_id: $('select#location_id').val() || '',
                expense_category_id: $('select#expense_category_id').val() || '',
                expense_sub_category_id: $('select#expense_sub_category_id_filter').val() || '',
                pjt_project_id: $('select#expense_pjt_project_id').val() || '',
                pjt_project_step_id: $('select#expense_pjt_project_step_id').val() || '',
                hide_project_expenses: $('#hide_project_expenses').is(':checked') ? 'true' : '',
                payment_status: $('select#expense_payment_status').val() || '',
                job_id: $('select#expense_job_filter').val() || '',
                start_date: start,
                end_date: end,
                show_deleted: $('#show_deleted').is(':checked') ? 'true' : '',
                tab: 'all'
            };
        }
    });
 </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>