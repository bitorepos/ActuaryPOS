<?php $__currentLoopData = $payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if($payment_line['is_return'] == 1): ?>
<?php
$change_return = $payment_line;
?>
<?php continue; ?>
<?php endif; ?>

<?php echo $__env->make('sale_pos.partials.payment_row_form_modal', ['removable' => !$loop->first, 'row_index' => $loop->index, 'payment_line' => $payment_line], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
