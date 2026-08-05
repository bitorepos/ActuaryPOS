<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.system_notification'); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
      <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
          $notification_data = $notification->data;
        ?>
        <div class="row">
          <div class="col-md-12 mb-10"><h4 class="modal-title"><?php echo $notification_data['subject']; ?></h4> <p class="text-muted"><?php echo e($notification->created_at->diffForHumans(), false); ?></p></div>
          <div class="col-md-12">
            <?php echo $notification_data['msg']; ?>

          </div>
        </div>
        <?php if($loop->index > 0): ?>
          <hr>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
