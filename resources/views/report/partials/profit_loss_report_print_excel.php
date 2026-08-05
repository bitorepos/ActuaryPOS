<table>
    <thead>
        <tr>
            <th colspan="3"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <?php if($tab === 'summary'): ?>
            <tr>
                <th><?php echo e(__('lang_v1.type'), false); ?></th>
                <th><?php echo e(__('lang_v1.description'), false); ?></th>
                <th><?php echo e(__('sale.total'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
            </tr>
        <?php else: ?>
            <tr>
                <th><?php echo e($tab_label, false); ?></th>
                <th><?php echo e(__('lang_v1.gross_profit'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
            </tr>
        <?php endif; ?>
    </thead>
    <tbody>
        <?php if($tab === 'summary'): ?>
            <?php $__currentLoopData = $summary_sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($section['title'], false); ?></td>
                        <td><?php echo e($row['label'], false); ?></td>
                        <td><?php echo e(round($row['value'], 2), false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($row['label'], false); ?></td>
                    <td><?php echo e(round($row['gross_profit'], 2), false); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(__('sale.total'), false); ?>:</td>
                <td><?php echo e(round($totals['gross_profit'], 2), false); ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
