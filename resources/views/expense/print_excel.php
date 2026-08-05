<?php
    $currency = ! empty($currency_symbol) ? ' ('.$currency_symbol.')' : '';
?>

<?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <table>
        <thead>
            <tr>
                <th colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($section['title'], false); ?></th>
            </tr>
            <tr>
                <th><?php echo e(__('purchase.business_location'), false); ?></th>
                <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($location_name, false); ?></td>
            </tr>
            <tr>
                <th><?php echo e(__('lang_v1.generated_on'), false); ?></th>
                <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($generated_at, false); ?></td>
            </tr>
            <?php if(! empty($filters_summary)): ?>
                <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($label, false); ?></th>
                        <td colspan="<?php echo e(max(count($section['columns']) - 1, 1), false); ?>"><?php echo e($value, false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr></tr>
            <tr>
                <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th>
                        <?php echo e($column['label'], false); ?>

                        <?php if(($column['type'] ?? '') === 'money'): ?>
                            <?php echo e($currency, false); ?>

                        <?php endif; ?>
                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $key = $column['key'];
                            $type = $column['type'] ?? 'text';
                            $value = $row[$key] ?? '';
                        ?>
                        <td>
                            <?php if($value === '' || $value === null): ?>
                                <?php echo e('', false); ?>

                            <?php elseif($type === 'money'): ?>
                                <?php echo e(round((float) $value, 2), false); ?>

                            <?php elseif($type === 'number'): ?>
                                <?php echo e(round((float) $value, 0), false); ?>

                            <?php else: ?>
                                <?php echo e($value, false); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="<?php echo e(max(count($section['columns']), 1), false); ?>"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if(! empty($section['rows'])): ?>
            <tfoot>
                <tr>
                    <?php $__currentLoopData = $section['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->first): ?>
                            <td><?php echo e(__('sale.total'), false); ?></td>
                        <?php elseif(! empty($column['total']) && ($column['type'] ?? '') === 'money'): ?>
                            <td><?php echo e(round((float) ($section['totals'][$column['key']] ?? 0), 2), false); ?></td>
                        <?php elseif(! empty($column['total']) && ($column['type'] ?? '') === 'number'): ?>
                            <td><?php echo e(round((float) ($section['totals'][$column['key']] ?? 0), 0), false); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
    <br>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
