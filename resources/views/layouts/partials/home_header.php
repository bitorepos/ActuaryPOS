<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand nav-link" href="/"><?php echo e(config('app.name', 'BitorePOS'), false); ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <?php if(Auth::check()): ?>
            <li><a href="<?php echo e(action([\App\Http\Controllers\HomeController::class, 'index']), false); ?>"><?php echo app('translator')->get('home.home'); ?></a></li>
        <?php endif; ?>
        <?php if(Route::has('frontend-pages') && config('app.env') != 'demo' 
        && !empty($frontend_pages)): ?>
            <?php $__currentLoopData = $frontend_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PageController::class, 'showPage'], $page->slug), false); ?>"><?php echo e($page->title, false); ?></a></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <li><a href="<?php echo e(route('docs.public'), false); ?>" target="_blank">Public Docs</a></li>
        <?php if(Route::has('pricing') && config('app.env') != 'demo' && empty(\App\System::getProperty('disable_pricing'))): ?>
        <li><a href="<?php echo e(action([\Modules\Superadmin\Http\Controllers\PricingController::class, 'index']), false); ?>"><?php echo app('translator')->get('superadmin::lang.pricing'); ?></a></li>
        <?php endif; ?>
        <?php if(Route::has('repair-status')): ?>
        <li>
          <a href="<?php echo e(action([\Modules\Repair\Http\Controllers\CustomerRepairStatusController::class, 'index']), false); ?>">
            <?php echo app('translator')->get('repair::lang.repair_status'); ?>
          </a>
        </li>
        <?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(Route::has('login')): ?>
            <?php if(!Auth::check()): ?>
                <li><a href="<?php echo e(route('login'), false); ?>"><?php echo app('translator')->get('lang_v1.login'); ?></a></li>
                <?php if(config('constants.allow_registration')): ?>
                    <li><a href="<?php echo e(registration_url(), false); ?>"><?php echo app('translator')->get('lang_v1.register'); ?></a></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
      </ul>
    </div><!-- nav-collapse -->
  </div>
</nav>
