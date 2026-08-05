<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($table_datasets) + 1, 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($period_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e($period_title, false); ?></th>
            <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <th><?php echo e($dataset['label'], false); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($row['label'], false); ?></td>
                <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($row['values'][$dataset['key']] ?? 0, false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(! empty($rows)): ?>
            <tr>
                <td><?php echo e(__('sale.total'), false); ?></td>
                <?php $__currentLoopData = $table_datasets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($totals[$dataset['key']] ?? 0, false); ?></td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
