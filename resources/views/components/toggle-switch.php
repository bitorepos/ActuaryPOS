<div class="col-2">
  <label class="switch-light switch-candy" onclick="">
      <input type="checkbox" name="<?php echo e($name, false); ?>" <?php if($checked): ?> checked <?php endif; ?>>
      <span>
          <span></span>
          <span></span>
          <a></a>
      </span>
  </label>
</div>
<div class="col-10">
  <?php echo e($label, false); ?>

</div>
