<?php $widgetCollapseId = 'wc_' . md5(($title ?? '') . ($id ?? uniqid())); ?>
<div class="card radius-10 <?php echo e($class ?? 'box-solid', false); ?>" <?php if(!empty($id)): ?> id="<?php echo e($id, false); ?>" <?php endif; ?>>
    <?php if(empty($header)): ?>
        <?php if(!empty($title) || !empty($tool)): ?>
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <?php echo $icon ?? ''; ?>

                <?php if(!empty($collapsible)): ?>
                    <h6 class="card-title mb-0 d-inline">
                        <a class="text-dark text-decoration-none" data-bs-toggle="collapse" href="#<?php echo e($widgetCollapseId, false); ?>" role="button" aria-expanded="<?php echo e(empty($collapsed) ? 'true' : 'false', false); ?>">
                            <?php echo e($title ?? '', false); ?> <i class="fa fa-chevron-<?php echo e(empty($collapsed) ? 'up' : 'down', false); ?> fa-xs ms-1"></i>
                        </a>
                    </h6>
                <?php else: ?>
                    <h6 class="card-title mb-0 d-inline"><?php echo e($title ?? '', false); ?></h6>
                <?php endif; ?>
            </div>
            <?php echo $tool ?? ''; ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="card-header">
            <?php echo $header; ?>

        </div>
    <?php endif; ?>

    <?php if(!empty($collapsible)): ?>
        <div class="collapse <?php echo e(empty($collapsed) ? 'show' : '', false); ?>" id="<?php echo e($widgetCollapseId, false); ?>">
            <div class="card-body">
                <?php echo e($slot, false); ?>

            </div>
        </div>
    <?php else: ?>
        <div class="card-body">
            <?php echo e($slot, false); ?>

        </div>
    <?php endif; ?>
    <!-- /.card-body -->
</div>
