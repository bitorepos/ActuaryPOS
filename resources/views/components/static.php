<div class="info-box info-box-new-style">
    <?php if(!empty($svg)): ?>
        <span class="info-box-icon <?php echo e($svg_bg ?? '', false); ?> <?php echo e($svg_text ?? '', false); ?> ">
            <?php echo $svg; ?>

        </span>    
        <?php echo e($slot, false); ?>

    <?php endif; ?>
    <!-- /.info-box-content -->
</div>
