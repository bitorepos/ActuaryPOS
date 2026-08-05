<table class="pdf-head">
    <tr>
        <td style="width: 50%;">
            <?php if(! empty($logo)): ?>
                <img src="<?php echo e($logo, false); ?>" class="pdf-logo" alt="logo"><br>
            <?php endif; ?>
            <div class="pdf-biz-name"><?php echo e($business_name, false); ?></div>
            <div class="pdf-biz-loc"><?php echo e($location_name, false); ?></div>
        </td>
        <td style="width: 50%; text-align: right;">
            <div class="pdf-report-title"><?php echo e($report_title, false); ?></div>
            <div class="pdf-report-sub"><?php echo e(__('lang_v1.generated_on'), false); ?>: <?php echo e($generated_at, false); ?></div>
        </td>
    </tr>
</table>

<?php if(! empty($contact_summary) || ! empty($filters_summary)): ?>
    <div class="pdf-filters">
        <?php $__currentLoopData = $contact_summary ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($value !== '' && $value !== null): ?>
                <span><b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?></span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $filters_summary ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($value !== '' && $value !== null): ?>
                <span><b><?php echo e($label, false); ?>:</b> <?php echo e(is_array($value) ? ($value['value'] ?? '') : $value, false); ?></span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
