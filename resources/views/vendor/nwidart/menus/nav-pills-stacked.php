<ul class="nav nav-pills nav-stacked">
  <?php echo $__env->make('menus::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</ul>
