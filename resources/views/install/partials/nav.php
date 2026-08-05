<?php
    $order = ['install' => 1, 'server' => 2, 'app_details' => 3, 'success' => 4];
    $currentIdx = $order[$active ?? 'install'] ?? 1;
    $steps = [
        ['key' => 'install',     'num' => 1, 'label' => 'Instructions'],
        ['key' => 'app_details', 'num' => 2, 'label' => 'Configuration'],
        ['key' => 'success',     'num' => 3, 'label' => 'Finish'],
    ];
?>
<ul class="install-stepper">
    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $idx = $order[$step['key']];
            $state = $idx < $currentIdx ? 'done' : ($idx == $currentIdx ? 'active' : '');
        ?>
        <li class="<?php echo e($state, false); ?>">
            <span class="step-num">
                <?php if($state === 'done'): ?>
                    <i class="bi bi-check2"></i>
                <?php else: ?>
                    <?php echo e($step['num'], false); ?>

                <?php endif; ?>
            </span>
            <span class="step-label"><?php echo e($step['label'], false); ?></span>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
