<?php
    $us = $user_settings ?? [];
    $show_category = empty($us['rpt_admin_exp_hide_expense_categories']);
    $show_total = empty($us['rpt_admin_exp_hide_total_expense']);
?>
<table>
    <thead>
        <tr>
            <th colspan="2"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <?php if($show_category): ?><th><?php echo e(__('expense.expense_categories'), false); ?></th><?php endif; ?>
            <?php if($show_total): ?><th><?php echo e(__('report.total_expense'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php if($show_category): ?><td><?php echo e($row['category'], false); ?></td><?php endif; ?>
                <?php if($show_total): ?><td><?php echo e(round($row['total_expense'], 2), false); ?></td><?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php if($show_category): ?><td><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
            <?php if($show_total): ?><td><?php echo e(round($total_expense, 2), false); ?></td><?php endif; ?>
        </tr>
    </tbody>
</table>
