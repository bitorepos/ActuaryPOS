<strong><i class="fa fa-info margin-r-5"></i> <?php echo app('translator')->get('contact.tax_no'); ?></strong>
<p class="text-muted">
    <?php echo e($contact->tax_number, false); ?>

</p>
<br>
<strong>Is Tax Inclusive:</strong><p> <?php echo e(($contact->is_inclusive) ? 'Yes': 'No', false); ?></p> 

<?php if($contact->pay_term_type): ?>
    <strong><i class="fa fa-calendar margin-r-5"></i> <?php echo app('translator')->get('contact.pay_term_period'); ?></strong>
    <p class="text-muted">
        <?php echo e(__('lang_v1.' . $contact->pay_term_type), false); ?>

    </p>
<?php endif; ?>
<?php if($contact->pay_term_number): ?>
    <strong><i class="fas fa fa-handshake margin-r-5"></i> <?php echo app('translator')->get('contact.pay_term'); ?></strong>
    <p class="text-muted">
        <?php echo e($contact->pay_term_number, false); ?>

    </p>
<?php endif; ?>
