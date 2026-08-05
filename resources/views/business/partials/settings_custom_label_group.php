<?php
    $custom_label_group_key = $custom_label_group_key ?? null;
    $custom_label_group_title = $custom_label_group_title ?? null;
    $custom_label_fields = $custom_label_fields ?? [];
    $custom_label_col = $custom_label_col ?? 'col-sm-3';
    $custom_label_required = !empty($custom_label_required);
    $custom_label_contact_default = !empty($custom_label_contact_default);
    $custom_label_hide = !empty($custom_label_hide);
    $custom_label_values = isset($custom_labels)
        && isset($custom_labels[$custom_label_group_key])
        && is_array($custom_labels[$custom_label_group_key])
        ? $custom_labels[$custom_label_group_key]
        : [];
?>

<?php if(!empty($custom_label_group_key) && !empty($custom_label_fields)): ?>
    <div class="clearfix"></div>
    <?php if(!empty($custom_label_group_title)): ?>
        <div class="col-sm-12 <?php echo e($custom_label_hide ? 'hide' : '', false); ?>">
            <h4><?php echo $custom_label_group_title; ?>:</h4>
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $custom_label_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom_label_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $field_key = $custom_label_field['key'];
            $field_id = $custom_label_field['id'] ?? ($custom_label_group_key . '_' . $field_key . '_label');
            $field_label = $custom_label_field['label'] ?? __('lang_v1.custom_field', ['number' => $loop->iteration]);
            $field_default = $custom_label_field['default'] ?? null;
            $field_value = $custom_label_values[$field_key] ?? $field_default;
            $required_key = 'is_' . $field_key . '_required';
            $contact_default_key = 'is_' . $field_key . '_contact_default';
        ?>
        <div class="<?php echo e($custom_label_col, false); ?> <?php echo e($custom_label_hide ? 'hide' : '', false); ?>">
            <div class="form-group mb-3">
                <?php echo Form::label($field_id, $field_label); ?>

                <?php if($custom_label_required || $custom_label_contact_default): ?>
                    <div class="input-group">
                        <?php echo Form::text(
                            'custom_labels[' . $custom_label_group_key . '][' . $field_key . ']',
                            $field_value,
                            ['class' => 'form-control', 'id' => $field_id]
                        ); ?>

                        <?php if($custom_label_required): ?>
                            <div class="input-group-text">
                                <input type="hidden" name="custom_labels[<?php echo e($custom_label_group_key, false); ?>][<?php echo e($required_key, false); ?>]" value="0">
                                <label class="mb-0">
                                    <input type="checkbox" name="custom_labels[<?php echo e($custom_label_group_key, false); ?>][<?php echo e($required_key, false); ?>]" value="1" class="form-check-input m-auto me-1" <?php if(!empty($custom_label_values[$required_key]) && $custom_label_values[$required_key] == 1): ?> checked <?php endif; ?>>
                                    <?php echo app('translator')->get('lang_v1.is_required'); ?>
                                </label>
                            </div>
                        <?php endif; ?>
                        <?php if($custom_label_contact_default): ?>
                            <div class="input-group-text">
                                <input type="hidden" name="custom_labels[<?php echo e($custom_label_group_key, false); ?>][<?php echo e($contact_default_key, false); ?>]" value="0">
                                <label class="mb-0">
                                    <input type="checkbox" name="custom_labels[<?php echo e($custom_label_group_key, false); ?>][<?php echo e($contact_default_key, false); ?>]" value="1" class="form-check-input m-auto me-1" <?php if(!empty($custom_label_values[$contact_default_key]) && $custom_label_values[$contact_default_key] == 1): ?> checked <?php endif; ?>>
                                    <?php echo app('translator')->get('lang_v1.is_default_for_contact'); ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <?php echo Form::text(
                        'custom_labels[' . $custom_label_group_key . '][' . $field_key . ']',
                        $field_value,
                        ['class' => 'form-control', 'id' => $field_id]
                    ); ?>

                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
