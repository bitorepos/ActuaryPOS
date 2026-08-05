<!--start sidebar -->
<?php
  $business_name = Session::get('business.name');
  if (empty($business_name) && auth()->check()) {
      $business_name = \App\Business::where('id', auth()->user()->business_id)->value('name');
      if (!empty($business_name)) {
          Session::put('business.name', $business_name);
      }
  }
  $business_name = $business_name ?: config('app.name', 'BitorePOS');
?>
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div class="logo-icon-div">
      <img src="<?php echo e(asset('favicon.ico'), false); ?>" class="logo-icon" alt="logo icon">
    </div>
    <div style="overflow: hidden; flex: 1; min-width: 0;">
      <h4 class="logo-text" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><a href="<?php echo e(route('home'), false); ?>" class="text-decoration-none" title="<?php echo e($business_name, false); ?>"><?php echo e($business_name, false); ?></a></h4>
    </div>
    
  </div>
  <!--navigation-->
  <?php echo Menu::render('admin-sidebar-menu', 'onedash'); ?>

  <!--end navigation-->
</aside>
<!--end sidebar -->
