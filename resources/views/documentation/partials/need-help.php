
<?php
    $contactSlug = 'contact-superadmin';
    $isOnContactPage = (!empty($activeSlug) && $activeSlug === $contactSlug);
    $contactUrl = !empty($isPublic)
        ? route('docs.public', $contactSlug)
        : route('documentation.index', $contactSlug);
?>

<?php if(!$isOnContactPage): ?>
<div class="docs-need-help" id="docs-need-help">
    <div class="docs-need-help-inner">
        <i class="bi bi-question-circle"></i>
        <div>
            <strong>Need Help?</strong>
            <p class="mb-0">
                If something on your Dashboard doesn't look right, use the
                <a href="<?php echo e($contactUrl, false); ?>" class="docs-need-help-link" data-slug="<?php echo e($contactSlug, false); ?>">Contact Superadmin</a>
                tab in the Documentation section to get help from your system administrator.
            </p>
        </div>
    </div>
</div>
<?php endif; ?>
