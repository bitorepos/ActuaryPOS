<?php if(isset($projects) && $projects->count()): ?>
<?php
    $project_select_id = $project_select_id ?? 'pjt_project_id';
    $step_select_id = $step_select_id ?? 'pjt_project_step_id';
    $selected_project_id = $selected_project_id ?? null;
    $selected_project_step_id = $selected_project_step_id ?? null;
    $initial_steps = [];

    if (! empty($selected_project_id) && ! empty($project_steps_by_project[$selected_project_id])) {
        foreach ($project_steps_by_project[$selected_project_id] as $step) {
            $initial_steps[$step['id']] = $step['text'];
        }
    }
?>
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="form-group mb-2">
            <?php echo Form::label($project_select_id, __('project::lang.project') . ':'); ?>

            <?php echo Form::select('pjt_project_id', $projects, $selected_project_id, ['class' => 'form-control select2', 'id' => $project_select_id, 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-group mb-2">
            <?php echo Form::label($step_select_id, __('project::lang.project_steps') . ':'); ?>

            <?php echo Form::select('pjt_project_step_id', $initial_steps, $selected_project_step_id, ['class' => 'form-control select2', 'id' => $step_select_id, 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

        </div>
    </div>
</div>
<script>
    (function (window, document) {
        var rawStepsByProject = <?php echo json_encode($project_steps_by_project ?? [], 15, 512) ?>;
        var projectSelector = '#<?php echo e($project_select_id, false); ?>';
        var stepSelector = '#<?php echo e($step_select_id, false); ?>';
        var selectedStep = <?php echo json_encode((string) $selected_project_step_id, 15, 512) ?>;
        var placeholder = <?php echo json_encode(__('messages.please_select'), 15, 512) ?>;

        function bootProjectStepDropdown() {
            if (! window.jQuery) {
                window.setTimeout(bootProjectStepDropdown, 50);
                return;
            }

            var $ = window.jQuery;
            var stepsByProject = {};

            $.each(rawStepsByProject || {}, function (projectId, steps) {
                stepsByProject[String(projectId)] = $.map(steps || [], function (step) {
                    return {
                        id: String(step.id),
                        text: step.text || step.name || ''
                    };
                });
            });

            function refreshSelect2($select) {
                if (! $.fn.select2 || ! $select.length || ! $select.hasClass('select2-hidden-accessible')) {
                    return;
                }

                var select2Options = { width: '100%' };
                var $modal = $select.closest('.modal');

                if ($modal.length) {
                    select2Options.dropdownParent = $select.parent();
                }

                if ($('html').attr('dir') == 'rtl') {
                    select2Options.dir = 'rtl';
                }

                $select.select2('destroy').select2(select2Options);
            }

            function syncProjectSteps() {
                var projectId = String($(projectSelector).val() || '');
                var steps = projectId && stepsByProject[projectId] ? stepsByProject[projectId] : [];
                var $step = $(stepSelector);
                var stepIsSelected = false;

                if (! $step.length) {
                    return;
                }

                $step.empty().append(new Option(placeholder, ''));

                $.each(steps, function (i, step) {
                    $step.append(new Option(step.text, step.id));

                    if (selectedStep && String(step.id) === String(selectedStep)) {
                        stepIsSelected = true;
                    }
                });

                $step.val(stepIsSelected ? selectedStep : '');
                $step.prop('disabled', false);
                refreshSelect2($step);
                $step.trigger('change');
            }

            $(document)
                .off('change.projectExpenseStep', projectSelector)
                .on('change.projectExpenseStep', projectSelector, function () {
                    selectedStep = '';
                    syncProjectSteps();
                });

            syncProjectSteps();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', bootProjectStepDropdown);
        } else {
            bootProjectStepDropdown();
        }
    })(window, document);
</script>
<?php endif; ?>
