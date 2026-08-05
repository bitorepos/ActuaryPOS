<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
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
            <th>Total Inflow</th>
            <td><?php echo e(round($summary['inflow'] ?? 0, 2), false); ?></td>
        </tr>
        <tr>
            <th>Total Outflow</th>
            <td><?php echo e(round($summary['outflow'] ?? 0, 2), false); ?></td>
        </tr>
        <tr>
            <th><?php echo e(__('lang_v1.net_cash_flows'), false); ?></th>
            <td><?php echo e(round($summary['net'] ?? 0, 2), false); ?></td>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="2">Daily Closing Sheet</th>
        </tr>
        <tr>
            <th><?php echo e(__('lang_v1.description'), false); ?></th>
            <th><?php echo e(__('sale.total'), false); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $summary['categories'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($category['label'] ?? '', false); ?></td>
                <td><?php echo e(round($category['amount'] ?? 0, 2), false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr></tr>
        <tr>
            <th colspan="4"><?php echo e(__('lang_v1.payment_method'), false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('lang_v1.payment_method'), false); ?></th>
            <th>In</th>
            <th>Out</th>
            <th><?php echo e(__('lang_v1.net_cash_flows'), false); ?></th>
        </tr>
        <?php $__currentLoopData = $summary['methods'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($method['label'] ?? '', false); ?></td>
                <td><?php echo e(round($method['inflow'] ?? 0, 2), false); ?></td>
                <td><?php echo e(round($method['outflow'] ?? 0, 2), false); ?></td>
                <td><?php echo e(round($method['net'] ?? 0, 2), false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
