<?php
    $__date_settings = is_array($date_settings ?? null) ? $date_settings : [];
    $__date_setting_key = $date_range_setting_key ?? 'reports_filter_date_range';
    $__date_setting_input_id = $date_range_setting_input_id ?? 'reports_filter_date_range';
    $__date_loc = array_key_first($__date_settings);
    $__reports_filter_date_range = ! is_null($__date_loc) && is_array($__date_settings[$__date_loc] ?? null)
        ? ($__date_settings[$__date_loc][$__date_setting_key] ?? ($__date_settings[$__date_loc]['reports_filter_date_range'] ?? null))
        : ($__date_settings[$__date_setting_key] ?? ($__date_settings['reports_filter_date_range'] ?? null));
?>

<?php if(!empty($__reports_filter_date_range)): ?>
    <?php echo Form::hidden($__date_setting_input_id, $__reports_filter_date_range, ['id' => $__date_setting_input_id]); ?>

<?php endif; ?>
