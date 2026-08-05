<ul class="nav navbar-nav navbar-left">
  <?php echo $__env->make('menus::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</ul>
