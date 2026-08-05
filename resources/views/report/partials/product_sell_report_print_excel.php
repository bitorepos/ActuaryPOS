<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
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
                    <?php
                        $value = $row[$column['key']] ?? '';
                        if (($column['type'] ?? '') === 'qty') {
                            $unit_key = $column['unit_key'] ?? null;
                            $value = trim(round((float) $value, 2).' '.($unit_key ? ($row[$unit_key] ?? '') : ''));
                        } elseif (($column['type'] ?? '') === 'percent' && $value !== '' && $value !== null) {
                            $value = round((float) $value, 2).'%';
                        }
                    ?>
                    <td><?php echo e($value, false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(! empty($rows)): ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <td><?php echo e(__('sale.total'), false); ?></td>
                    <?php elseif(! empty($column['total'])): ?>
                        <?php
                            $value = $totals[$column['key']] ?? '';
                            if (($column['type'] ?? '') === 'qty') {
                                $value = round((float) $value, 2);
                            } elseif (($column['type'] ?? '') === 'percent' && $value !== '' && $value !== null) {
                                $value = round((float) $value, 2).'%';
                            } elseif (($column['type'] ?? '') === 'money' && $value !== '' && $value !== null) {
                                $value = round((float) $value, 2);
                            }
                        ?>
                        <td><?php echo e($value, false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
