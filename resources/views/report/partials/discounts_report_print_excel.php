<?php
    if (! function_exists('_drp_excel_value')) {
        function _drp_excel_value($value, $type) {
            if ($value === null || $value === '') return '';
            if (in_array($type, ['money', 'quantity'])) return number_format((float) $value, 2, '.', '');
            if ($type === 'number') return number_format((float) $value, 0, '.', '');
            if ($type === 'percent') return number_format((float) $value, 2, '.', '').'%';
            return $value;
        }
    }
?>
<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <?php if(! empty($filters_summary)): ?>
            <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($label, false); ?></th>
                    <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e(is_array($value) ? ($value['value'] ?? '') : $value, false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(! empty($summary_cards)): ?>
            <tr></tr>
            <tr>
                <?php $__currentLoopData = $summary_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($card['label'], false); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <tr>
                <?php $__currentLoopData = $summary_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e(_drp_excel_value($card['value'] ?? '', $card['type'] ?? 'text'), false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
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
                    <td><?php echo e(_drp_excel_value($row[$column['key']] ?? '', $column['type'] ?? 'text'), false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(! empty($rows)): ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <td><?php echo e(__('sale.total'), false); ?></td>
                    <?php elseif(! empty($column['total'])): ?>
                        <td><?php echo e(_drp_excel_value($totals[$column['key']] ?? '', $column['type'] ?? 'text'), false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
