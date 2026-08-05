<?php $request = app('Illuminate\Http\Request'); ?>
<div class="row no-print">
  <div class="col-md-12">
    <a href="<?php echo e(action([\App\Http\Controllers\HomeController::class, 'index']), false); ?>" title="<?php echo e(__('lang_v1.go_back'), false); ?>" data-bs-toggle="tooltip" data-placement="bottom" class="btn btn-info btn-flat d-none d-sm-inline btn-sm mt-2 me-3 float-end">
        <strong><i class="fa fa-backward fa-lg"></i></strong>
    </a>
  </div>
</div>
