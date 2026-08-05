<?php
    $filterId = $id ?? ('collapseFilter-' . uniqid());
    $isOpen = $open ?? false; // default collapsed globally
?>

<div class="card radius-10 <?php if(!empty($class)): ?> <?php echo e($class, false); ?> <?php else: ?> box-solid <?php endif; ?>" id="accordion">
  <div class="card-header d-flex align-items-center" style="cursor: pointer;"
       data-bs-toggle="collapse"
       data-bs-target="#<?php echo e($filterId, false); ?>"
       aria-expanded="<?php echo e($isOpen ? 'true' : 'false', false); ?>"
       aria-controls="<?php echo e($filterId, false); ?>">
    <h6 class="card-title mb-0">
          <?php if(!empty($icon)): ?> <?php echo $icon; ?> <?php else: ?> <i class="fa fa-filter" aria-hidden="true"></i> <?php endif; ?> <?php echo e($title ?? '', false); ?>

    </h6>
    <i class="bi bi-chevron-down ms-auto"></i>
  </div>

  <div id="<?php echo e($filterId, false); ?>" class="collapse <?php if($isOpen): ?> show <?php endif; ?>" aria-expanded="<?php echo e($isOpen ? 'true' : 'false', false); ?>">
    <div class="card-body row align-items-start">
      <?php echo e($slot, false); ?>

    </div>
  </div>
</div>
