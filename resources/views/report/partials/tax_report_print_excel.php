<table>
    <thead>
        <tr>
            <th colspan="<?php echo e(max(count($columns), 2), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
        </tr>
        <tr>
            <th><?php echo e(__('lang_v1.description'), false); ?></th>
            <th style="text-align: right;"><?php echo e(__('sale.total'), false); ?> (<?php echo e($currency_symbol, false); ?>)</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $overview_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $overview_row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($overview_row['label'], false); ?></td>
                <td style="text-align: right;"><?php echo e(round($overview_row['value'], 2), false); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr><td colspan="<?php echo e(max(count($columns), 2), false); ?>"></td></tr>
        <tr>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount'; ?>
                <th <?php if($is_value_column): ?> style="text-align: right;" <?php endif; ?>>
                    <?php echo e($column['label'], false); ?>

                    <?php if($is_value_column): ?>
                        (<?php echo e($currency_symbol, false); ?>)
                    <?php endif; ?>
                </th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $value = $row[$column['key']] ?? '';
                        $is_tax_column = strpos($column['key'], 'tax_') === 0;
                        $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount';
                    ?>
                    <td <?php if($is_value_column): ?> style="text-align: right;" <?php endif; ?>>
                        <?php if($column['type'] === 'money'): ?>
                            <?php echo e($is_tax_column && (float) $value == 0 ? '' : round((float) $value, 2), false); ?>

                        <?php else: ?>
                            <?php echo e($value, false); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <?php $total_label_printed = false; ?>
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $is_tax_column = strpos($column['key'], 'tax_') === 0;
                    $is_value_column = $column['type'] === 'money' || $column['key'] === 'discount_amount';
                ?>
                <td <?php if($is_value_column): ?> style="text-align: right;" <?php endif; ?>>
                    <?php if($column['key'] === 'total_before_tax'): ?>
                        <?php echo e(round($totals['total_before_tax'] ?? 0, 2), false); ?>

                    <?php elseif($is_tax_column): ?>
                        <?php echo e(round($totals[$column['key']] ?? 0, 2), false); ?>

                    <?php elseif($column['key'] === 'payment_methods'): ?>
                        <?php echo e($payment_method_summary, false); ?>

                    <?php elseif(! $total_label_printed): ?>
                        <?php echo e(__('sale.total'), false); ?>:
                        <?php $total_label_printed = true; ?>
                    <?php endif; ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
    </tbody>
</table>
