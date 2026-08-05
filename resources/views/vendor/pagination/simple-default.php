<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="disabled"><span><?php echo app('translator')->get('pagination.previous'); ?></span></li>
        <?php else: ?>
            <li><a href="<?php echo e($paginator->previousPageUrl(), false); ?>" rel="prev"><?php echo app('translator')->get('pagination.previous'); ?></a></li>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li><a href="<?php echo e($paginator->nextPageUrl(), false); ?>" rel="next"><?php echo app('translator')->get('pagination.next'); ?></a></li>
        <?php else: ?>
            <li class="disabled"><span><?php echo app('translator')->get('pagination.next'); ?></span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
