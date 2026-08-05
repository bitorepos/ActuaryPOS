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
        <div class="cr-report-sub"><?php echo e(__('lang_v1.generated_on'), false); ?>: <?php echo e($generated_at, false); ?></div>
    </div>
</div>

<div class="cr-filters account-book-meta">
    <span class="f-item"><b><?php echo e(__('account.account_name'), false); ?>:</b> <?php echo e($account->name, false); ?></span>
    <?php if(! empty($account_type_name)): ?>
        <span class="f-item"><b><?php echo e(__('lang_v1.account_type'), false); ?>:</b> <?php echo e($account_type_name, false); ?></span>
    <?php endif; ?>
    <?php if(! empty($account->account_number)): ?>
        <span class="f-item"><b><?php echo e(__('account.account_number'), false); ?>:</b> <?php echo e($account->account_number, false); ?></span>
    <?php endif; ?>
    <span class="f-item"><b><?php echo e(__('lang_v1.balance'), false); ?>:</b> <?php echo e(_ab_print_money($account_balance ?? 0, $decimal_separator, $thousand_separator), false); ?></span>
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
