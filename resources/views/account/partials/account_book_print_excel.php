<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('account.account_name'), false); ?></th>
            <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($account->name, false); ?></td>
        </tr>
        <?php if(! empty($account_type_name)): ?>
            <tr>
                <th><?php echo e(__('lang_v1.account_type'), false); ?></th>
                <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($account_type_name, false); ?></td>
            </tr>
        <?php endif; ?>
        <?php if(! empty($account->account_number)): ?>
            <tr>
                <th><?php echo e(__('account.account_number'), false); ?></th>
                <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e($account->account_number, false); ?></td>
            </tr>
        <?php endif; ?>
        <tr>
            <th><?php echo e(__('lang_v1.balance'), false); ?></th>
            <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e(round($account_balance ?? 0, 2), false); ?></td>
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
                <th>
                    <?php echo e($column['label'], false); ?>

                    <?php if(($column['type'] ?? '') === 'money' && ! empty($currency_symbol)): ?>
                        (<?php echo e($currency_symbol, false); ?>)
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $key = $column['key'];
                        $type = $column['type'] ?? 'text';
                    ?>
                    <td>
                        <?php if($type === 'money'): ?>
                            <?php echo e($row[$key] === null || $row[$key] === '' ? '' : round($row[$key], 2), false); ?>

                        <?php else: ?>
                            <?php echo e($row[$key] ?? '', false); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <?php if(! empty($rows)): ?>
        <tfoot>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->first): ?>
                        <td><?php echo e(__('sale.total'), false); ?></td>
                    <?php elseif(! empty($column['total']) && ($column['type'] ?? '') === 'money'): ?>
                        <td><?php echo e(round($totals[$column['key']] ?? 0, 2), false); ?></td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>
