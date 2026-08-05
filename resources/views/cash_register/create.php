
<?php $__env->startSection('title',  __('cash_register.open_cash_register')); ?>

<?php $__env->startSection('content'); ?>
<style type="text/css">
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('cash_register.open_cash_register'); ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>
<?php
// Phase 63: prefer controller-supplied per-branch overlay; session is the fallback.
$pos_settings = isset($pos_settings) && ! empty($pos_settings)
    ? $pos_settings
    : json_decode(session()->get('business.pos_settings'), true);
?>
<!-- Main content -->
<section class="content">
<?php if($is_offline && !empty($pos_settings['enable_cash_register_sync_with_workstations'])): ?>
<div class="box box-primary">
  <div class="box-body box box-primary">
  <div class="col-sm-6 col-sm-offset-3 text-center">
    <button type="button" id="offline_sync_cash_registers" class="btn btn-primary btn-lg"><?php echo app('translator')->get('cash_register.sync_cash_register'); ?></button>
  </div>
  </div>
</div>
<?php else: ?>
  <?php echo Form::open(['url' => action([\App\Http\Controllers\CashRegisterController::class, 'store']), 'method' => 'post', 
  'id' => 'add_cash_register_form' ]); ?>

    <div class="box box-primary">
      <div class="box-body box box-primary">
      <br><br><br>
      <input type="hidden" name="sub_type" value="<?php echo e($sub_type, false); ?>">
        <div class="row">
            <?php if($business_locations->count() > 0): ?>
              <div class="col-sm-8 col-sm-offset-2">
                <div class="mb-3">
                  <?php echo Form::label('amount', __('cash_register.cash_in_hand') . ':*'); ?>

                  <?php echo Form::text('amount', null, ['class' => 'form-control input_number',
                    'placeholder' => __('cash_register.enter_amount'), 'required']); ?>

                </div>
              </div>
              <?php if(count($business_locations) > 1): ?>
                <div class="clearfix"></div>
                <div class="col-sm-8 col-sm-offset-2">
                  <div class="mb-3">
                    <?php echo Form::label('location_id', __('business.business_location') . ':'); ?>

                      <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2',]); ?>

                  </div>
                </div>
              <?php else: ?>
                <?php echo Form::hidden('location_id', array_key_first($business_locations->toArray()) ); ?>

              <?php endif; ?>
              <div class="col-sm-8 col-sm-offset-2">
                <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('cash_register.open_register'); ?></button>
              </div>
            <?php else: ?>
              <div class="col-sm-8 col-sm-offset-2 text-center">
                <h3><?php echo app('translator')->get('lang_v1.no_location_access_found'); ?></h3>
              </div>
            <?php endif; ?>
        </div>
        <br><br><br>
      </div>
    </div>
    <?php echo Form::close(); ?>

<?php endif; ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
  $('form#add_cash_register_form input#amount').focus();
  $('form#add_cash_register_form input#amount').on('keypress', function(e) {
    if (e.which === 13) {
      e.preventDefault();
      $('form#add_cash_register_form').submit();
    }
  });
  $(document).on('click', '#offline_sync_cash_registers',  function(e){
      var loader = __fa_awesome();
      var btn = $(this);
      var btn_html = $(this).html();
      btn.html(loader); 
      btn.attr('disabled', true);
      $.ajax({
          url: "/offline-sync/sync-cash-registers",
          dataType: "json",
          success: function(result){
              if(result.success){
                  toastr.success(result.msg);
                  if(result.redirect){
                      btn.html('Redirecting to POS...');
                      window.location.href = result.redirect;
                  }else{
                    toastr.warning('No Open Register Found');
                  }
              } else {
                  toastr.error(result.msg);
              }
              btn.html(btn_html);
              btn.removeAttr('disabled');
          }
      });          
  });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>