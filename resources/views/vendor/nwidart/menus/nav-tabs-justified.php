<ul class="nav nav-tabs nav-justified">
  <?php echo $__env->make('menus::menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</ul>
