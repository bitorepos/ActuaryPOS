<?php
    $qty_precision = session('business.quantity_precision', 2);

    if (! function_exists('_tp_excel_value')) {
        function _tp_excel_value($value, $type, $qty_precision) {
            if ($value === null || $value === '') return '';
            if ($type === 'quantity') return number_format((float) $value, $qty_precision, '.', '');
            if ($type === 'number') return number_format((float) $value, 0, '.', '');
            return $value;
        }
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($section_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <?php if(! empty($filters_summary)): ?>
            <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($label, false); ?></th>
                    <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e(is_array($value) ? ($value['value'] ?? '') : $value, false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <tr></tr>
        <tr>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($column['label'], false); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e(_tp_excel_value($row[$column['key']] ?? '', $column['type'] ?? 'text', $qty_precision), false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(! empty($rows)): ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <td><?php echo e(__('sale.total'), false); ?></td>
                    <?php elseif(! empty($column['total'])): ?>
                        <td><?php echo e(_tp_excel_value($totals[$column['key']] ?? '', $column['type'] ?? 'text', $qty_precision), false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
