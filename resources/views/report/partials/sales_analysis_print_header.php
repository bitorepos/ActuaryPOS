<div class="cr-head">
    <div class="cr-head-left">
        <?php if(! empty($logo)): ?>
            <img src="<?php echo e($logo, false); ?>" class="cr-logo" alt="logo">
        <?php endif; ?>
        <div>
            <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
            <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
        </div>
    </div>
    <div class="cr-head-right">
        <div class="cr-report-title"><?php echo e($report_title, false); ?></div>
        <div class="cr-report-sub"><?php echo e($period_title, false); ?> - <?php echo e(__('lang_v1.generated_on'), false); ?>: <?php echo e($generated_at, false); ?></div>
    </div>
</div>

<?php if(! empty($filters_summary)): ?>
    <div class="cr-filters">
        <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                if (is_array($value)) {
                    $label = $value['label'] ?? $label;
                    $value = $value['value'] ?? '';
                }
            ?>
            <?php if($value !== '' && $value !== null): ?>
                <span class="f-item"><b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?></span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
