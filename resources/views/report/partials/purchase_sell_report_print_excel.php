<table>
    <thead>
        <tr>
            <th colspan="3"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('lang_v1.type'), false); ?></th>
            <th><?php echo e(__('lang_v1.description'), false); ?></th>
            <th><?php echo e(__('sale.total'), false); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($section['title'], false); ?></td>
                    <td><?php echo e($row['label'], false); ?></td>
                    <td><?php echo e(round($row['value'], 2), false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
